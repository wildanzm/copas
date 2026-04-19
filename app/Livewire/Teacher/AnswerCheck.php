<?php

namespace App\Livewire\Teacher;

use App\Models\Node;
use App\Models\StudentAnswer;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Periksa Jawaban')]
class AnswerCheck extends Component
{
    public User $student;

    public function mount(User $student)
    {
        abort_unless($student->school === \Illuminate\Support\Facades\Auth::user()->school, 403, 'Unauthorized. Student not from your school.');
        $this->student = $student;
    }

    public function render()
    {
        $nodes = Node::with(['questions' => function ($query) {
            $query->orderBy('id');
        }])->orderBy('order_index')->get();

        $answers = StudentAnswer::where('user_id', $this->student->id)
            ->get()
            ->keyBy('question_id');

        return view('livewire.teacher.answer-check', [
            'nodes' => $nodes,
            'answers' => $answers,
        ]);
    }
}
