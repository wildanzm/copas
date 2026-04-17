<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Copas | Detail Pembelajaran')]
#[Layout('layouts.app.teacher-sidebar')]
class DashboardDetail extends Component
{
    public function render()
    {
        return view('livewire.teacher.dashboard-detail');
    }
}
