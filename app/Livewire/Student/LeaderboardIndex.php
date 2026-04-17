<?php

namespace App\Livewire\Student;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Peringkat')]
class LeaderboardIndex extends Component
{
    public function getLeaderboardProperty()
    {
        $user = Auth::user();

        // Get everyone in the same school (or just all students if school is not strictly used)
        // Here we use the same school logic as the dashboard
        return User::where('school', $user->school)
            ->role('student')
            ->withSum('studentAnswers as total_xp', 'xp_earned')
            ->orderByDesc('total_xp')
            ->get();
    }

    public function getMyRankProperty()
    {
        $userId = Auth::id();
        $rank = 0;

        foreach ($this->leaderboard as $index => $student) {
            if ($student->id === $userId) {
                $rank = $index + 1;
                break;
            }
        }

        return $rank;
    }

    public function getStudentLevelProperty(): int
    {
        return Auth::user()->level;
    }

    public function getStudentXpProperty(): int
    {
        return Auth::user()->studentAnswers()->sum('xp_earned');
    }

    public function render()
    {
        return view('livewire.student.leaderboard-index', [
            'leaderboard' => $this->leaderboard,
            'myRank' => $this->myRank,
            'level' => $this->studentLevel,
            'xp' => $this->studentXp,
        ]);
    }
}
