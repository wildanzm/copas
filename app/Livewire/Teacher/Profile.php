<?php

namespace App\Livewire\Teacher;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app.teacher-sidebar')]
#[Title('Copas | Profil')]
class Profile extends Component
{
    use WithFileUploads;

    public $name;

    public $username;

    public $email;

    public $school;

    public $password;

    public $avatar;

    public $storedAvatar;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->username = $user->username;
        $this->email = $user->email;
        $this->school = $user->school;
        $this->storedAvatar = $user->avatar;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $rules = [
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username,'.$user->id,
            'email' => 'required|email|max:255|unique:users,email,'.$user->id,
            'school' => 'required|string|max:255',
            'password' => 'nullable|string|min:6',
        ];

        $this->validate($rules);

        $user->name = $this->name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->school = $this->school;

        if (! empty($this->password)) {
            $user->password = Hash::make($this->password);
        }

        if ($this->avatar) {
            $avatarPath = $this->avatar->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $this->storedAvatar = $avatarPath;
            $this->reset('avatar');
        }

        $user->save();
        $this->reset('password');

        $this->dispatch('profile-updated', message: 'Profil Anda berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.teacher.profile');
    }
}
