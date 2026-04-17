<?php

namespace App\Livewire\Student;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Tentang')]
class TentangIndex extends Component
{
    public function render()
    {
        return view('livewire.student.tentang-index');
    }
}
