<?php

namespace App\Livewire\Teacher;

use Livewire\Component;
use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Teacher Dashboard')]
#[Layout('layouts.app.teacher-sidebar')]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.teacher.dashboard');
    }
}
