<?php

namespace App\Livewire\Teacher;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Daftar Kelas')]
class Classroom extends Component
{
    public function render()
    {
        return view('livewire.teacher.classroom');
    }
}
