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
        // Eager load only the necessary student answers by using whereHas on the relationship
        $students = User::role('student')->with(['studentAnswers' => function ($query) {
            $query->whereHas('question', function ($q) {
                $q->where('type', 'final_quiz');
            });
        }])->get();

        // Query total questions only ONCE
        $totalQuestions = Question::where('type', 'final_quiz')->count();

        return $students->map(function ($student) use ($totalQuestions) {
            // Use the ALREADY eagerly loaded relationship instead of a new query
            $answers = $student->studentAnswers;

            $hasAnswers = $answers->isNotEmpty();
            $correctCount = $answers->where('xp_earned', '>', 0)->count();
            $score = $hasAnswers ? ($totalQuestions > 0 ? round(($correctCount / $totalQuestions) * 100) : 0) : '-';

            // Get duration from time_spent column
            $durationSeconds = $hasAnswers ? ($answers->first()->time_spent ?? 0) : 0;
            $finishTime = '-';

            if ($hasAnswers && $durationSeconds > 0) {
                $m = floor($durationSeconds / 60);
                $s = $durationSeconds % 60;
                $finishTime = sprintf('%02d:%02d', $m, $s);
            }

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
        $school = auth()->user()->school;
        $studentIds = User::where('school', $school)->role('student')->pluck('id');

        $avgTimeSeconds = StudentAnswer::whereIn('user_id', $studentIds)
            ->whereHas('question', function ($q) {
                $q->where('type', 'final_quiz');
            })
            ->avg('time_spent') ?: 0;

        $minutes = floor($avgTimeSeconds / 60);
        $seconds = round($avgTimeSeconds % 60);

        return sprintf('%02d:%02d', $minutes, $seconds);
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
