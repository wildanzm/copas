<?php

namespace App\Livewire\Student;

use App\Models\Node;
use App\Models\StudentProgress;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Dashboard Siswa')]
class Dashboard extends Component
{
    public function getCompletedNodesCountProperty(): int
    {
        return StudentProgress::query()
            ->where('user_id', Auth::id())
            ->where('status', 'completed')
            ->count();
    }

    public function getProgressPercentageProperty(): float|int
    {
        $totalNodes = Node::count() ?: 5;

        return ($this->completedNodesCount / $totalNodes) * 100;
    }

    public function getUnlockedNodeProperty(): int
    {
        return $this->completedNodesCount + 1;
    }

    public function getStudentLevelProperty(): int
    {
        return Auth::user()->level;
    }

    public function getStudentXpProperty(): int
    {
        return Auth::user()->studentAnswers()->sum('xp_earned');
    }

    public function getLeaderboardProperty()
    {
        $user = Auth::user();

        // Asumsikan kita menampilkan leaderboard untuk teman-teman yang memiliki school name yang sama.
        return User::where('school', $user->school)
            ->role('student')
            ->withSum('studentAnswers as total_xp', 'xp_earned')
            ->orderByDesc('total_xp')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.student.dashboard', [
            'level' => $this->studentLevel,
            'xp' => $this->studentXp,
            'leaderboard' => $this->leaderboard,
        ]);
    }
}
