<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Teacher Dashboard')]
#[Layout('layouts.app.teacher-sidebar')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.teacher.dashboard');
    }
}
