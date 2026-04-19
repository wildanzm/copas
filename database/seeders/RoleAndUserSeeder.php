<?php

namespace Database\Seeders;

use App\Models\ClassRoom;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndUserSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // Create a teacher
        $teacher = User::factory()->create([
            'name' => 'Guru, S.Pd',
            'email' => 'guru@gmail.com',
            'username' => 'guru',
            'school' => 'SD Negeri 1',
            'password' => Hash::make('guru1234'),
        ]);
        $teacher->assignRole($teacherRole);

        // Create a classroom for the teacher
        $classroom = ClassRoom::create([
            'name' => 'Kelas 5A',
            'teacher_id' => $teacher->id,
        ]);

        // Create a primary student
        $student = User::factory()->create([
            'name' => 'Siswa',
            'email' => 'siswa@gmail.com',
            'username' => 'siswa',
            'school' => 'SD Negeri 1',
            'password' => Hash::make('siswa123'),
            'class_id' => $classroom->id,
            'gender' => 'Laki-laki',
        ]);
        $student->assignRole($studentRole);
    }
}
