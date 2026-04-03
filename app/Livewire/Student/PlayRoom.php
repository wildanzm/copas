<?php

declare(strict_types=1);

namespace App\Livewire\Student;

use App\Models\Node;
use Illuminate\View\View;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Play Room')]
class PlayRoom extends Component
{
    public Node $node;

    public array $answers = [];

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

    public function submitNode1(): void
    {
        $this->validate([
            'answers.q1' => 'required|string',
            'answers.q2' => 'required|string',
            'answers.q3' => 'required|string',
        ], [
            'answers.*.required' => 'Jawaban ini wajib diisi.',
        ]);

        // Logika untuk menyimpan answer ke DB (misal: StudentAnswer::create({...}))
        // akan diletakan di sini.

        session()->flash('message', 'Jawaban berhasil dikirim!');
    }

    public function render(): View
    {
        return view('livewire.student.play-room', [
            'nodeView' => 'livewire.student.nodes.node-'.$this->node->order_index,
        ]);
    }
}
