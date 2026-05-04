<?php

namespace App\Livewire\Teacher;

use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Kuis')]
class Quiz extends Component
{
    public function getStudentAnswersProperty()
    {
        $students = User::role('student')->with(['studentAnswers' => function ($query) {
            $query->whereHas('question', function ($q) {
                $q->where('type', 'final_quiz');
            });
        }])->get();

        return $students->map(function ($student) {
            $answers = $student->studentAnswers()
                ->whereHas('question', function ($q) {
                    $q->where('type', 'final_quiz');
                })
                ->get();

            $totalQuestions = Question::where('type', 'final_quiz')->count();
            $hasAnswers = $answers->isNotEmpty();
            $correctCount = $answers->where('xp_earned', '>', 0)->count();
            $score = $hasAnswers ? ($totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0) : '-';

            // Get latest answer as finish time
            $finishTime = $hasAnswers
                ? $answers->max('created_at')->format('H:i')
                : '-';

            return [
                'id' => $student->id,
                'name' => $student->name,
                'avatar' => $student->avatar,
                'finish_time' => $finishTime,
                'score' => $score,
                'answers' => $answers,
                'correct_count' => $correctCount,
                'total_questions' => $totalQuestions,
                'has_answers' => $hasAnswers,
            ];
        });
    }

    public function getAverageTimeProperty()
    {
        $answers = StudentAnswer::whereHas('question', function ($q) {
            $q->where('type', 'final_quiz');
        })->get();

        if ($answers->isEmpty()) {
            return '00:00';
        }

        $totalSeconds = 0;
        $userCount = 0;

        foreach ($answers->groupBy('user_id') as $userAnswers) {
            $time = $userAnswers->max('created_at');
            if ($time) {
                // Get seconds since midnight
                $totalSeconds += ($time->hour * 3600) + ($time->minute * 60) + $time->second;
                $userCount++;
            }
        }

        $avgSeconds = $userCount > 0 ? $totalSeconds / $userCount : 0;
        $minutes = floor($avgSeconds / 60);
        $hours = floor($minutes / 60);
        $minutes = $minutes % 60;

        return str_pad($hours, 2, '0', STR_PAD_LEFT).':'.str_pad($minutes, 2, '0', STR_PAD_LEFT);
    }

    public function getAverageScoreProperty()
    {
        $students = $this->studentAnswers->filter(fn ($s) => $s['has_answers']);
        if ($students->isEmpty()) {
            return '0%';
        }

        $avgScore = round($students->avg('score'));

        return $avgScore.'%';
    }

    public function getLowestScoreProperty()
    {
        $students = $this->studentAnswers->filter(fn ($s) => $s['has_answers']);
        if ($students->isEmpty()) {
            return '0%';
        }

        $lowestScore = $students->min('score');

        return $lowestScore.'%';
    }

    public function getHighestScoreProperty()
    {
        $students = $this->studentAnswers->filter(fn ($s) => $s['has_answers']);
        if ($students->isEmpty()) {
            return '0%';
        }

        $highestScore = $students->max('score');

        return $highestScore.'%';
    }

    public function getQuestionsProperty()
    {
        return Question::where('type', 'final_quiz')
            ->with('options')
            ->orderBy('id')
            ->get();
    }

    public function render()
    {
        return view('livewire.teacher.quiz', [
            'studentAnswers' => $this->studentAnswers,
            'averageTime' => $this->averageTime,
            'averageScore' => $this->averageScore,
            'lowestScore' => $this->lowestScore,
            'highestScore' => $this->highestScore,
            'questions' => $this->questions,
        ]);
    }
}
