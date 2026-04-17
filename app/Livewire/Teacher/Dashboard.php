<?php

namespace App\Livewire\Teacher;

use App\Models\ClassRoom;
use App\Models\Node;
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
        $studentIds = $this->studentIds;

        $avgScore = StudentAnswer::whereIn('user_id', $studentIds)->avg('score') ?? 0;
        $minScore = StudentAnswer::whereIn('user_id', $studentIds)->min('score') ?? 0;
        $maxScore = StudentAnswer::whereIn('user_id', $studentIds)->max('score') ?? 0;

        return [
            'avg_time' => '12:45', // static for now as no duration field exists
            'avg_score' => round($avgScore, 1),
            'min_score' => round($minScore, 1),
            'max_score' => round($maxScore, 1),
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
