<?php

namespace App\Livewire\Teacher;

use App\Models\ClassRoom;
use App\Models\Node;
use App\Models\Question;
use App\Models\StudentAnswer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Copas | Dashboard Guru')]
#[Layout('layouts.app.teacher-sidebar')]
class Dashboard extends Component
{
    public function getStudentIdsProperty()
    {
        $classIds = ClassRoom::where('teacher_id', Auth::id())->pluck('id');

        return User::whereIn('class_id', $classIds)->role('student')->pluck('id');
    }

    public function getStudentsProgressProperty()
    {
        $classIds = ClassRoom::where('teacher_id', Auth::id())->pluck('id');
        $students = User::whereIn('class_id', $classIds)->role('student')->with('progress')->get();
        $totalNodes = Node::count() ?: 5;

        return $students->map(function ($student) use ($totalNodes) {
            $completedCount = $student->progress->where('status', 'completed')->count();
            $percentage = $totalNodes > 0 ? ($completedCount / $totalNodes) * 100 : 0;
            $student->progress_percentage = $percentage;

            return $student;
        })->sortByDesc('progress_percentage')->values();
    }

    public function getLeaderboardProperty()
    {
        return User::whereIn('id', $this->studentIds)
            ->withSum('studentAnswers as total_xp', 'xp_earned')
            ->orderByDesc('total_xp')
            ->take(5)
            ->get();
    }

    public function getQuizStatsProperty()
    {
        $school = Auth::user()->school;
        $allStudentIdsInSchool = User::where('school', $school)->role('student')->pluck('id');
        $studentIdsInClasses = $this->studentIds;

        $totalQuestions = Question::where('type', 'final_quiz')->count() ?: 1;
        $maxPossibleXp = $totalQuestions * 10;

        // School-wide average time
        $avgTimeSeconds = StudentAnswer::whereIn('user_id', $allStudentIdsInSchool)
            ->whereHas('question', function ($q) {
                $q->where('type', 'final_quiz');
            })
            ->avg('time_spent') ?: 0;

        $minutes = floor($avgTimeSeconds / 60);
        $seconds = round($avgTimeSeconds % 60);
        $formattedAvgTime = sprintf('%02d:%02d', $minutes, $seconds);

        // Score stats for teacher's classes
        $userScores = StudentAnswer::whereIn('user_id', $studentIdsInClasses)
            ->whereHas('question', function ($q) {
                $q->where('type', 'final_quiz');
            })
            ->selectRaw('user_id, SUM(xp_earned) as total_xp')
            ->groupBy('user_id')
            ->get();

        if ($userScores->isEmpty()) {
            return [
                'avg_time' => $formattedAvgTime,
                'avg_score' => 0,
                'min_score' => 0,
                'max_score' => 0,
            ];
        }

        $percentages = $userScores->map(function ($score) use ($maxPossibleXp) {
            return round(($score->total_xp / $maxPossibleXp) * 100);
        });

        return [
            'avg_time' => $formattedAvgTime,
            'avg_score' => round($percentages->avg(), 1),
            'min_score' => round($percentages->min(), 1),
            'max_score' => round($percentages->max(), 1),
        ];
    }

    public function render()
    {
        return view('livewire.teacher.dashboard', [
            'studentsProgress' => $this->studentsProgress,
            'leaderboard' => $this->leaderboard,
            'quizStats' => $this->quizStats,
        ]);
    }
}
