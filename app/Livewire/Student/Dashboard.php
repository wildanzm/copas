<?php

namespace App\Livewire\Student;

use App\Models\Node;
use App\Models\StudentProgress;
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

    public function render()
    {
        return view('livewire.student.dashboard');
    }
}
