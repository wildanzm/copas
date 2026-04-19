<?php

namespace App\Livewire\Student;

use App\Models\ClassRoom;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app.student-sidebar')]
#[Title('Copas | Profile')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;

    public $class_id;

    public $gender;

    public $avatar;

    public $storedAvatar;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->class_id = $user->class_id;
        $this->gender = $user->gender;
        $this->storedAvatar = $user->avatar;
    }

    public function updateProfile()
    {
        $this->validate([
            'avatar' => 'nullable|image|max:1024', // 1MB max
        ]);

        $user = Auth::user();

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();

            $this->storedAvatar = $avatarPath;
            $this->reset('avatar');

            $this->dispatch('profile-updated', message: 'Foto profil berhasil diperbarui!');
        } else {
            $this->dispatch('profile-no-change', message: 'Tidak ada perubahan pada foto profil.');
        }
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
        return view('livewire.student.profile', [
            'classes' => ClassRoom::all(),
            'level' => $this->studentLevel,
            'xp' => $this->studentXp,
        ]);
    }
}
