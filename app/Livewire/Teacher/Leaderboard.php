<?php

namespace App\Livewire\Teacher;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Peringkat Siswa')]
class Leaderboard extends Component
{
    public function getLeaderboardProperty()
    {
        $teacher = Auth::user();

        return User::where('school', $teacher->school)
            ->role('student')
            ->withSum('studentAnswers as total_xp', 'xp_earned')
            ->orderByDesc('total_xp')
            ->get();
    }

    public function render()
    {
        return view('livewire.teacher.leaderboard', [
            'leaderboard' => $this->leaderboard,
        ]);
    }
}
