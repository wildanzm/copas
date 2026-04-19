<?php

namespace App\Livewire\Teacher;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class Student extends Component
{
    use WithPagination;

    public $search = '';

    public $classFilter = '';

    // Modal state
    public $showModal = false;

    // Form fields
    public $editingId = null;

    public $name;

    public $class_id;

    public $new_class_name;

    public $gender;

    public $username;

    public $password;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingClassFilter()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->reset(['editingId', 'name', 'class_id', 'new_class_name', 'gender', 'username', 'password']);
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }

    public function editStudent($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        /** @var User $currentUser */
        $currentUser = Auth::user();

        $student = User::role('student')
            ->where('school', $currentUser->school)
            ->where('id', $id)
            ->first();

        if ($student) {
            $this->editingId = $student->id;
            $this->name = $student->name;
            $this->class_id = $student->class_id;
            $this->new_class_name = '';
            $this->gender = $student->gender;
            $this->username = $student->username;
            $this->password = ''; // Don't populate password

            $this->showModal = true;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Nama wajib diisi.',
            'class_id.required' => 'Kelas wajib dipilih.',
            'class_id.exists' => 'Kelas tidak valid.',
            'new_class_name.required' => 'Nama kelas baru wajib diisi.',
            'gender.required' => 'Jenis kelamin dicentang.',
            'gender.in' => 'Pilih Laki-laki atau Perempuan.',
            'username.required' => 'Nama pengguna wajib diisi.',
            'username.unique' => 'Nama pengguna sudah terdaftar.',
            'password.required' => 'Kata sandi wajib diisi.',
            'password.min' => 'Kata sandi minimal 6 karakter.',
        ];
    }

    public function save($addAnother = false)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'gender' => 'required|string|in:Laki-laki,Perempuan',
            'username' => 'required|string|max:255|unique:users,username'.($this->editingId ? ','.$this->editingId : ''),
        ];

        if ($this->class_id === 'new') {
            $rules['new_class_name'] = 'required|string|max:255';
        } else {
            $rules['class_id'] = 'required|exists:classes,id';
        }

        if ($this->editingId) {
            $rules['password'] = 'nullable|string|min:6';
        } else {
            $rules['password'] = 'required|string|min:6';
        }

        $this->validate($rules);

        /** @var User $currentUser */
        $currentUser = Auth::user();

        $finalClassId = $this->class_id;

        if ($this->class_id === 'new') {
            $newClass = ClassRoom::create([
                'name' => $this->new_class_name,
                'teacher_id' => $currentUser->id,
            ]);
            $finalClassId = $newClass->id;
        }

        $data = [
            'name' => $this->name,
            'class_id' => $finalClassId,
            'gender' => $this->gender,
            'username' => $this->username,
        ];

        if (! empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        if ($this->editingId) {
            $student = User::role('student')
                ->where('school', $currentUser->school)
                ->where('id', $this->editingId)
                ->first();

            if ($student) {
                $student->update($data);
                $this->dispatch('swal', [
                    'title' => 'Berhasil!',
                    'text' => 'Data murid berhasil diperbarui.',
                    'icon' => 'success',
                ]);
            }
        } else {
            $data['school'] = $currentUser->school;
            $data['email'] = $this->username.'@student.copas.com';

            $student = User::create($data);
            $student->assignRole('student');

            $this->dispatch('swal', [
                'title' => 'Berhasil!',
                'text' => 'Murid berhasil ditambahkan.',
                'icon' => 'success',
            ]);
        }

        if ($addAnother && ! $this->editingId) {
            $this->reset(['name', 'username', 'password']);
        } else {
            $this->showModal = false;
        }
    }

    public function deleteStudent($id)
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $student = User::role('student')
            ->where('school', $currentUser->school)
            ->where('id', $id)
            ->first();

        if ($student) {
            $student->delete();
            $this->dispatch('swal', [
                'title' => 'Terhapus!',
                'text' => 'Data murid berhasil dihapus.',
                'icon' => 'success',
            ]);
        }
    }

    public function render()
    {
        /** @var User $currentUser */
        $currentUser = Auth::user();

        $query = User::role('student')->where('school', $currentUser->school);

        if (! empty($this->search)) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('username', 'like', '%'.$this->search.'%');
            });
        }

        if (! empty($this->classFilter)) {
            $query->where('class_id', $this->classFilter);
        }

        $students = $query->orderBy('name', 'asc')->paginate(10);
        $classes = ClassRoom::where('teacher_id', $currentUser->id)->get();

        return view('livewire.teacher.student', compact('students', 'classes'));
    }
}
