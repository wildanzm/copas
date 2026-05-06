<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use App\Models\Node;
use App\Models\StudentAnswer;
use App\Models\StudentProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Play Room')]
class PlayRoom extends Component
{
    use WithFileUploads;

    public Node $node;

    public array $answers = [];

    public $photo;

    public bool $showModal = false;

    public int $earnedXp = 0;

    public int $correctCount = 0;

    public int $incorrectCount = 0;

    public bool $isLevelUp = false;

    public int $newLevel = 1;

    public int $oldLevel = 1;

    public int $oldXp = 0;

    public int $newXp = 0;

    public float $progressPercentage = 0;

    public function mount(int $nodeId): void
    {
        $completedNodes = StudentProgress::query()
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
        $unlockedNode = $completedNodes + 1;

        abort_unless($nodeId <= $unlockedNode, 403, 'Anda belum membuka misi ini.');

        $this->node = Node::with('questions.options')->where('order_index', $nodeId)->firstOrFail();

        $totalNodes = Node::count();
        $this->progressPercentage = ($nodeId / $totalNodes) * 100;
    }

    public function getEmbedVideoUrl(): ?string
    {
        $url = $this->node->video_url;

        if (! $url) {
            return null;
        }

        // Convert youtu.be/xxxx format
        if (str_contains($url, 'youtu.be/')) {
            $id = explode('youtu.be/', $url)[1];
            $id = explode('?', $id)[0];

            return "https://www.youtube.com/embed/{$id}";
        }

        // Convert youtube.com/watch?v=xxxx format
        if (str_contains($url, 'youtube.com/watch')) {
            parse_str((string) parse_url($url, PHP_URL_QUERY), $vars);
            if (isset($vars['v'])) {
                return "https://www.youtube.com/embed/{$vars['v']}";
            }
        }

        return $url;
    }

    public function markNodeAsCompleted(): void
    {
        StudentProgress::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'node_id' => $this->node->id,
            ],
            [
                'status' => 'completed',
                'unlocked_at' => now(),
            ]
        );
    }

    protected function saveStudentAnswers(?string $photoPath = null, array $xpPerQuestion = []): void
    {
        $userId = Auth::id();

        foreach ($this->node->questions as $index => $question) {
            $key = 'q'.($index + 1);
            if (isset($this->answers[$key])) {
                StudentAnswer::updateOrCreate(
                    [
                        'user_id' => $userId,
                        'question_id' => $question->id,
                    ],
                    [
                        'answer_text' => is_array($this->answers[$key]) ? json_encode($this->answers[$key]) : (string) $this->answers[$key],
                        'file_path' => ($index === 0 && $photoPath) ? $photoPath : null,
                        'xp_earned' => $xpPerQuestion[$index] ?? 0,
                    ]
                );
            }
        }
    }

    private function concludeNode(array $xpPerQuestion, string $flashMessage, ?string $photoPath = null): void
    {
        $user = Auth::user();

        // Fetch total XP once
        $this->oldXp = (int) $user->studentAnswers()->sum('xp_earned');
        $this->oldLevel = User::calculateLevel($this->oldXp);

        $this->saveStudentAnswers($photoPath, $xpPerQuestion);
        $this->markNodeAsCompleted();

        $this->earnedXp = array_sum($xpPerQuestion);
        $this->newXp = $this->oldXp + $this->earnedXp;
        $this->newLevel = User::calculateLevel($this->newXp);

        $this->isLevelUp = $this->newLevel > $this->oldLevel;
        $this->showModal = true;

        session()->flash('message', $flashMessage);
    }

    public function submitNode1(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
            'answers.q3' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        $this->concludeNode([50, 50, 50], 'Jawaban berhasil dikirim!');
    }

    public function submitNode2(): void
    {
        $rules = [];
        $messages = [];

        foreach ($this->node->questions as $index => $question) {
            $key = 'answers.q'.($index + 1);
            $rules[$key] = 'required|string';
            $messages[$key.'.required'] = 'Jawaban ini wajib diisi.';
        }

        $this->validate($rules, $messages);

        $xpPerQuestion = [];
        $correct = 0;
        $incorrect = 0;

        foreach ($this->node->questions as $index => $question) {
            $userAnswer = $this->answers['q'.($index + 1)] ?? null;

            // Check correctness against db options
            $correctOption = $question->options->where('is_correct', true)->first();

            if ($correctOption && $correctOption->option_text === $userAnswer) {
                $correct++;
                $xpPerQuestion[$index] = 20; // 100 max xp / 5
            } else {
                $incorrect++;
                $xpPerQuestion[$index] = 0;
            }
        }

        $this->correctCount = $correct;
        $this->incorrectCount = $incorrect;

        $this->concludeNode($xpPerQuestion, 'Kerja Bagus! Jawabanmu dikirim.');
    }

    public function submitNode3(): void
    {
        $this->validate([
            'photo' => 'required|image|max:2048', // 2MB maks
            'answers.q1' => 'required|string|min:5',
        ], [
            'photo.required' => 'Foto observasi wajib diunggah.',
            'photo.image' => 'File gambar tidak valid.',
            'photo.max' => 'Ukuran gambar maksimal 2MB.',
            'answers.q1.required' => 'Penjelasan observasi wajib diisi.',
            'answers.q1.min' => 'Penjelasan observasi terlalu singkat.',
        ]);

        $photoPath = $this->photo->store('observasi', 'public');
        $this->concludeNode([150], 'Luar Biasa! Hasil observasimu berhasil dikirim.', $photoPath);
    }

    public function submitNode4(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        $this->concludeNode([75, 75], 'Analisis yang Hebat! Jawabanmu tersimpan.');
    }

    public function submitNode5(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        $this->concludeNode([100], 'Kerja Bagus! Tantangan selesai.');
    }

    public function submitNode6(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
            'answers.q3' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        $this->concludeNode([50, 50, 50], 'Selamat! Kamu telah menyelesaikan semua misi.');
    }

    public function render(): View
    {
        return view('livewire.student.play-room', [
            'nodeView' => 'livewire.student.nodes.node-'.$this->node->order_index,
        ]);
    }
}
