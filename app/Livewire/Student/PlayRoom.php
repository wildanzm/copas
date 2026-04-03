<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use App\Models\Node;
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

    public function mount(int $nodeId): void
    {
        $this->node = Node::with('questions.options')->where('order_index', $nodeId)->firstOrFail();
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

    public function submitNode1(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
            'answers.q3' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        $this->markNodeAsCompleted();

        // Logika untuk menyimpan answer ke DB (misal: StudentAnswer::create({...}))
        // akan diletakan di sini.

        session()->flash('message', 'Jawaban berhasil dikirim!');
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

        // Nanti Letakkan logika penyimpanan jawaban di sini.

        $this->markNodeAsCompleted();

        session()->flash('message', 'Kerja Bagus! Jawabanmu dikirim.');
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

        // Logika untuk menyimpan answer ke DB (misal: StudentAnswer::create({...}))
        // include $this->photo->store('observasi', 'public')

        $this->markNodeAsCompleted();

        session()->flash('message', 'Luar Biasa! Hasil observasimu berhasil dikirim.');
    }

    public function submitNode4(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        // Simpan jawaban...

        $this->markNodeAsCompleted();

        session()->flash('message', 'Analisis yang Hebat! Jawabanmu tersimpan.');
    }

    public function submitNode5(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
            'answers.q3' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        // Simpan jawaban dan tandai selesai...
        $this->markNodeAsCompleted();

        session()->flash('message', 'Selamat! Kamu telah menyelesaikan semua misi.');
    }

    public function render(): View
    {
        return view('livewire.student.play-room', [
            'nodeView' => 'livewire.student.nodes.node-'.$this->node->order_index,
        ]);
    }
}
