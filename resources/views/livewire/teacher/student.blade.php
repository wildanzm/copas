<div class="flex flex-col gap-6 font-sans">
    
    <!-- Top Action Bar -->
    <div class="bg-white rounded-xl px-6 py-4 flex items-center justify-between shadow-sm">
        <h2 class="text-gray-600 font-bold text-lg">Murid</h2>
        <button wire:click="openModal" class="bg-[#4882C7] hover:bg-[#3A6AA0] text-white font-semibold py-2 px-6 rounded-xl text-sm transition-colors shadow-sm">
            Tambah Murid
        </button>
    </div>

    <!-- Filter & Search Bar -->
    <div class="bg-white rounded-xl px-6 py-3 flex items-center shadow-sm w-full gap-4">
        <div class="relative min-w-30">
            <select wire:model.live="classFilter" class="w-full appearance-none bg-transparent border-none text-gray-500 font-medium text-sm outline-none focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent focus:shadow-none cursor-pointer pl-2 pr-8 shadow-none ring-0">
                <option value="">Kelas</option>
                @foreach($classes as $class)
                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                @endforeach
            </select>
            <svg class="w-4 h-4 text-gray-400 absolute right-2 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
        </div>
        
        <div class="w-px h-6 bg-gray-200"></div>

        <div class="flex items-center flex-1 gap-2 text-gray-400">
            <svg class="w-5 h-5 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input wire:model.live.debounce.300ms="search" type="text" placeholder="Cari Siswa" class="w-full border-none outline-none focus:outline-none focus:ring-0 focus:ring-transparent focus:border-transparent focus:shadow-none text-sm text-gray-600 bg-transparent placeholder-gray-400 p-0 shadow-none ring-0">
        </div>
    </div>

    <!-- Table Container -->
    <div class="w-full">
        <!-- Desktop Table view -->
        <div class="hidden md:block w-full overflow-x-auto rounded-xl shadow-sm">
        <table class="w-full text-left text-sm whitespace-nowrap">
            <thead>
                <tr class="text-gray-700 font-bold border-b-2 border-white">
                    <th class="py-4 px-6 text-center">No.</th>
                    <th class="py-4 px-6">Nama Lengkap</th>
                    <th class="py-4 px-6">Nama Pengguna</th>
                    <th class="py-4 px-6">Jenis Kelamin</th>
                    <th class="py-4 px-6 text-center">Pembelajaran</th>
                    <th class="py-4 px-6 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($students as $student)
                <tr class="odd:bg-white even:bg-[#E8F2FC] font-medium text-gray-600">
                    <td class="py-4 px-6 text-center">{{ $loop->index + 1 + (($students->currentPage() - 1) * $students->perPage()) }}</td>
                    <td class="py-4 px-6 flex items-center gap-3">
                        <div class="w-8 h-8 rounded-full bg-gray-200 overflow-hidden border border-gray-300 shrink-0">
                            @if($student->avatar)
                                <img src="{{ asset('storage/'.$student->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                            @else
                                <img src="{{ asset('assets/icons/dashboard/profil.png') }}" class="w-full h-full object-contain p-1.5" alt="Avatar">
                            @endif
                        </div>
                        <span class="font-semibold text-gray-700">{{ $student->name }}</span>
                    </td>
                    <td class="py-4 px-6">{{ $student->username }}</td>
                    <td class="py-4 px-6">{{ $student->gender }}</td>
                    <td class="py-4 px-6 text-center">
                        <a href="{{ route('teacher.answer-check', $student->id) }}" class="text-[#2B73CA] hover:text-blue-700 font-bold transition-colors">Periksa</a>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <div class="flex items-center justify-center gap-4">
                            <button wire:click="editStudent({{ $student->id }})" class="text-yellow-500 hover:text-yellow-600 font-bold transition-colors">Ubah</button>
                            <button @click="$dispatch('swal-confirm', { id: {{ $student->id }} })" class="text-[#F98E8E] hover:text-red-500 font-bold transition-colors">Hapus</button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr class="bg-white">
                    <td colspan="7" class="py-8 px-6 text-center text-gray-500 font-medium">Tidak ada murid yang ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        </div>

        <!-- Mobile Card view -->
        <div class="md:hidden flex flex-col gap-4">
            @forelse($students as $student)
            <div class="bg-white p-5 rounded-xl shadow-sm border border-gray-100 flex flex-col gap-4 relative">
                <span class="absolute top-4 right-4 text-xs font-bold text-gray-400 bg-gray-100 px-2 py-1 rounded-md">
                    #{{ $loop->index + 1 + (($students->currentPage() - 1) * $students->perPage()) }}
                </span>
                
                <div class="flex items-center gap-4 border-b border-gray-100 pb-4">
                    <div class="w-12 h-12 rounded-full bg-gray-200 overflow-hidden border border-gray-300 shrink-0">
                        @if($student->avatar)
                            <img src="{{ asset('storage/'.$student->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('assets/icons/dashboard/profil.png') }}" class="w-full h-full object-contain p-2" alt="Avatar">
                        @endif
                    </div>
                    <div class="flex flex-col gap-1 pr-10">
                        <span class="font-bold text-gray-700 text-base leading-tight">{{ $student->name }}</span>
                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 font-medium">
                            <span class="bg-[#E8F2FC] text-[#2B73CA] px-2 py-0.5 rounded">{{ $student->username }}</span>
                            <span class="bg-gray-100 px-2 py-0.5 rounded">{{ $student->gender }}</span>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-col gap-3 pt-1">
                    <a href="{{ route('teacher.answer-check', $student->id) }}" class="flex items-center justify-center gap-2 w-full text-white bg-[#4882C7] hover:bg-[#3A6AA0] font-bold text-sm px-4 py-2.5 rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        Periksa Jawaban
                    </a>
                    
                    <div class="flex items-center justify-between gap-3 gap-x-4 mt-1 border-t border-gray-100 pt-4">
                        <button wire:click="editStudent({{ $student->id }})" class="flex-1 text-yellow-600 hover:text-yellow-700 font-bold text-sm bg-yellow-50 hover:bg-yellow-100 py-2 rounded-lg transition-colors flex justify-center items-center gap-1">
                            Ubah Data
                        </button>
                        <button @click="$dispatch('swal-confirm', { id: {{ $student->id }} })" class="flex-1 text-red-500 hover:text-red-600 font-bold text-sm bg-red-50 hover:bg-red-100 py-2 rounded-lg transition-colors flex justify-center items-center gap-1">
                            Hapus
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="bg-white p-8 rounded-xl shadow-sm text-center text-gray-500 font-medium">
                Tidak ada murid yang ditemukan.
            </div>
            @endforelse
        </div>
        
        @if($students->hasPages())
        <div class="mt-4 px-4 pb-4">
            {{ $students->links() }}
        </div>
        @endif
    </div>

    <!-- Tambah/Ubah Murid Modal -->
    <div x-data="{ show: @entangle('showModal') }" 
         x-show="show" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
         
        <div class="bg-white w-full max-w-2xl rounded-2xl shadow-xl p-8 relative mx-4 border border-gray-100"
             @click.outside="show = false"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
             x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
             
            <!-- Close Button -->
            <button wire:click="closeModal" class="absolute top-4 right-4 p-2 bg-gray-100 hover:bg-gray-200 rounded-md text-gray-500 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>

            <h3 class="text-2xl font-bold text-gray-700 mb-8 mt-2">{{ $editingId ? 'Ubah Murid' : 'Tambah Murid' }}</h3>

            <form wire:submit.prevent="save(false)" class="flex flex-col gap-6">
                <!-- Row 1: Nama & Dropdowns -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2 relative pb-5">
                        <label class="text-xs font-semibold text-gray-400">Nama</label>
                        <input wire:model="name" type="text" class="border border-gray-200 rounded-xl text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500 text-gray-600 placeholder-gray-300" placeholder="Masukkan nama">
                        @error('name') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                    </div>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col justify-start relative pb-5">
                            <label class="text-xs font-semibold text-transparent mb-2 hidden md:block">.</label>
                            <div class="relative w-full">
                                <select wire:model.live="class_id" class="w-full border border-gray-200 rounded-xl text-sm p-3 appearance-none focus:outline-none focus:ring-1 focus:ring-blue-500 bg-transparent text-gray-400">
                                    <option value="">Kelas</option>
                                    @foreach($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                    <option value="new">+ Tambah Kelas</option>
                                </select>
                                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            @error('class_id') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                        </div>
                        
                        <div class="flex flex-col justify-start relative pb-5">
                            <label class="text-xs font-semibold text-transparent mb-2 hidden md:block">.</label>
                            <div class="relative w-full">
                                <select wire:model="gender" class="w-full border border-gray-200 rounded-xl text-sm p-3 appearance-none focus:outline-none focus:ring-1 focus:ring-blue-500 bg-transparent text-gray-400">
                                    <option value="">Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                                <svg class="w-4 h-4 text-gray-400 absolute right-3 top-1/2 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                            @error('gender') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                @if($class_id === 'new')
                <div class="col-span-1 md:col-span-2 relative pb-5">
                    <label class="text-xs font-semibold text-gray-400">Nama Kelas</label>
                    <input wire:model="new_class_name" type="text" class="w-full border border-gray-200 rounded-xl text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500 text-gray-600 placeholder-gray-300" placeholder="Contoh: Kelas 7A">
                    @error('new_class_name') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                </div>
                @endif

                <!-- Row 2: Nama Pengguna -->
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col gap-2 relative pb-5">
                        <label class="text-xs font-semibold text-gray-400">Nama Pengguna</label>
                        <input wire:model="username" type="text" class="border border-gray-200 rounded-xl text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500 text-gray-600 placeholder-gray-300" placeholder="Username">
                        @error('username') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Row 3: Kata Sandi -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col gap-2 relative pb-5">
                        <label class="text-xs font-semibold text-gray-400">Kata Sandi @if($editingId)<span class="font-normal text-[10px]">(Opsional)</span>@endif</label>
                        <input wire:model="password" type="text" class="border border-gray-200 rounded-xl text-sm p-3 focus:outline-none focus:ring-1 focus:ring-blue-500 text-gray-600 placeholder-gray-300" placeholder="Kata sandi">
                        @error('password') <span class="text-red-500 text-[10px] absolute bottom-0 left-0">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex items-center justify-start gap-6 mt-6">
                    @if(!$editingId)
                    <button type="button" wire:click="save(true)" class="flex items-center gap-2 text-gray-500 hover:text-gray-800 font-bold text-sm transition-colors cursor-pointer group">
                        <div class="w-5 h-5 rounded-full border-2 border-gray-400 flex items-center justify-center text-gray-500 group-hover:border-gray-800 group-hover:text-gray-800 transition-colors pt-0.5">
                            <span class="text-lg leading-none font-medium mb-1">+</span>
                        </div>
                        Tambah Lainnya
                    </button>
                    @endif
                    
                    <button type="submit" class="bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold py-2.5 px-6 rounded text-sm transition-colors">
                        {{ $editingId ? 'Simpan Perubahan' : 'Tambah Murid' }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('swal-confirm', function(e) {
            let id = e.detail.id;
            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Data murid akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.call('deleteStudent', id);
                }
            });
        });

        document.addEventListener('livewire:initialized', () => {
            Livewire.on('swal', (event) => {
                let data = event[0] || event;
                Swal.fire({
                    title: data.title,
                    text: data.text,
                    icon: data.icon,
                    confirmButtonColor: '#3085d6',
                });
            });
        });
    </script>
</div>
