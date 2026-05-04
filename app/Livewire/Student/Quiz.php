<?php

namespace App\Livewire\Student;

use App\Models\Node;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Kuis')]
class Quiz extends Component
{
    public function getIsCompletedProperty()
    {
        // For the sake of this mock, assume completion if there are any answers
        // or check node 6 logic if we make one
        return Auth::user()->studentAnswers()->whereHas('question', function ($q) {
            $q->where('type', 'final_quiz');
        })->exists();
    }

    public function getFinishedTimeProperty()
    {
        $answer = Auth::user()->studentAnswers()->whereHas('question', function ($q) {
            $q->where('type', 'final_quiz');
        })->latest('created_at')->first();

        return $answer ? $answer->created_at->format('H:i') : '00:00';
    }

    public function getMyScoreProperty()
    {
        $xp = Auth::user()->studentAnswers()->whereHas('question', function ($q) {
            $q->where('type', 'final_quiz');
        })->sum('xp_earned');

        $totalQuestions = \App\Models\Question::where('type', 'final_quiz')->count();
        $maxPossibleXp = $totalQuestions * 10;

        if ($xp > 0 && $maxPossibleXp > 0) {
            return round(($xp / $maxPossibleXp) * 100).'%';
        }

        return '0%';
    }

    public function getHighestScoreProperty()
    {
        // highest score in the same class/school
        $highestXp = User::where('school', Auth::user()->school)
            ->role('student')
            ->withSum(['studentAnswers as total_final_xp' => function ($query) {
                $query->whereHas('question', function ($q) {
                    $q->where('type', 'final_quiz');
                });
            }], 'xp_earned')
            ->orderByDesc('total_final_xp')
            ->first()
            ->total_final_xp ?? 0;

        $totalQuestions = \App\Models\Question::where('type', 'final_quiz')->count();
        $maxPossibleXp = $totalQuestions * 10;

        if ($highestXp > 0 && $maxPossibleXp > 0) {
            return round(($highestXp / $maxPossibleXp) * 100).'%';
        }

        return '0%';
    }

    public function getStudentLevelProperty(): int
    {
        return Auth::user()->level;
    }

    public function getStudentXpProperty(): int
    {
        return Auth::user()->studentAnswers()->sum('xp_earned');
    }

    public function startQuiz()
    {
        return redirect()->route('student.quiz.play');
    }

    public function render()
    {
        return view('livewire.student.quiz', [
            'isCompleted' => $this->isCompleted,
            'finishedTime' => $this->finishedTime,
            'myScore' => $this->myScore,
            'highestScore' => $this->highestScore,
            'level' => $this->studentLevel,
            'xp' => $this->studentXp,
        ]);
    }
}
