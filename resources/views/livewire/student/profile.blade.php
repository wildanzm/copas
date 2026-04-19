<div class="px-6 py-8 md:px-12 md:py-10 max-w-4xl mx-auto">
    <!-- Header Badge -->
    <div class="flex justify-end mb-16">
        <div
            class="bg-[#2D74DB] rounded-lg shadow whitespace-nowrap flex items-center text-white px-4 py-2 font-bold gap-6">
            <div class="flex items-center gap-2">
                <img src="{{ asset('assets/icons/etc/medal.png') }}" class="h-6 w-6 object-contain" alt="XP Medal">
                <span class="text-xl">{{ $xp }}</span>
            </div>

            <div class="flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-[#FF5A5F]" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path
                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-xl italic">Level {{ $level }}</span>
            </div>
        </div>
    </div>

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('profile-updated', (event) => {
                let msg = event.message || (event[0] && event[0].message) ||
                    'Foto profil berhasil diperbarui!';
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: msg,
                    confirmButtonColor: '#2D74DB'
                });
            });

            Livewire.on('profile-no-change', (event) => {
                let msg = event.message || (event[0] && event[0].message) || 'Tidak ada perubahan.';
                Swal.fire({
                    icon: 'info',
                    title: 'Info',
                    text: msg,
                    confirmButtonColor: '#2D74DB'
                });
            });
        });
    </script>

    @if (session()->has('message'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: '{{ session('message') }}',
                    confirmButtonColor: '#2D74DB'
                });
            });
        </script>
    @endif

    <!-- Main Profile Card -->
    <div
        class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-14 relative w-full h-auto flex items-center justify-center">

        <div class="w-full max-w-4xl flex flex-col md:flex-row gap-12 md:gap-20 m-auto">

            <!-- Left Side: Avatar -->
            <div x-data="avatarCrop()" class="flex flex-col items-center shrink-0 pt-4">

                <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

                <div class="relative w-[280px] h-[280px] bg-[#2B73CA] rounded-full overflow-hidden shadow-inner mb-4 flex items-center justify-center group cursor-pointer"
                    @click="$refs.fileInput.click()">
                    @if ($avatar)
                        <img src="{{ $avatar->temporaryUrl() }}" class="w-full h-full object-cover">
                    @elseif ($storedAvatar)
                        <img src="{{ asset('storage/' . $storedAvatar) }}?v={{ time() }}"
                            class="w-full h-full object-cover">
                    @else
                        <!-- Default Icon for Empty Avatar -->
                        <img src="{{ asset('assets/icons/dashboard/profil.png') }}"
                            class="w-1/2 h-1/2 object-contain opacity-80" alt="Default Avatar">
                    @endif

                    <!-- Loading overlay during upload -->
                    <div x-show="isUploading"
                        class="absolute inset-0 bg-white bg-opacity-70 flex items-center justify-center z-10"
                        style="display: none;">
                        <svg class="animate-spin h-8 w-8 text-blue-600" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                <button type="button" @click="$refs.fileInput.click()"
                    class="bg-[#e4e4e4] border border-[#aeaeae] hover:bg-gray-300 text-black font-bold py-1.5 px-3 rounded-md text-sm flex items-center gap-1 transition shadow-sm mb-2">
                    Ganti Gambar
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
                <div class="text-xs text-red-500 font-medium tracking-wide">Maksimal ukuran file 1MB</div>

                <input type="file" x-ref="fileInput" @change="onFileChange" class="hidden" accept="image/*">
                @error('avatar')
                    <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                @enderror

                <!-- Crop Modal -->
                <div x-show="showModal" style="display: none;"
                    class="fixed inset-0 z-[9999] overflow-y-auto flex items-center justify-center"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">

                    <!-- Transparent background -->
                    <div x-show="showModal" x-transition.opacity
                        class="fixed inset-0 bg-transparent backdrop-blur-sm transition-opacity" aria-hidden="true">
                    </div>

                    <!-- Modal Content -->
                    <div x-show="showModal" x-transition
                        class="relative bg-white rounded-xl shadow-2xl text-left overflow-hidden transform transition-all sm:my-8 sm:max-w-lg w-full mx-4 border border-gray-100 z-50">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Sesuaikan
                                    Gambar (1:1)</h3>
                                <div
                                    class="w-full max-h-[60vh] overflow-hidden rounded-lg bg-transparent flex justify-center items-center">
                                    <img x-ref="cropImage" class="max-w-full max-h-[60vh] object-contain">
                                </div>
                            </div>
                        </div>
                        <div
                            class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse rounded-b-xl border-t border-gray-200">
                            <button type="button" @click="saveCrop"
                                class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-[#FF7A00] text-base font-bold text-white hover:bg-orange-600 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                Simpan
                            </button>
                            <button type="button" @click="closeModal"
                                class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-bold text-gray-700 hover:bg-gray-50 focus:outline-none sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Batal
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener('alpine:init', () => {
                        Alpine.data('avatarCrop', () => ({
                            showModal: false,
                            isUploading: false,
                            cropper: null,

                            onFileChange(e) {
                                let file = e.target.files[0];
                                if (!file) return;

                                if (file.size > 1024 * 1024) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Ukuran file melebihi 1MB! (File Anda: ' + (file.size / 1024 /
                                            1024).toFixed(2) + 'MB)',
                                        confirmButtonColor: '#d33',
                                    });
                                    e.target.value = '';
                                    return;
                                }

                                let reader = new FileReader();
                                reader.onload = (e) => {
                                    this.$refs.cropImage.src = e.target.result;
                                    this.showModal = true;

                                    setTimeout(() => {
                                        if (this.cropper) {
                                            this.cropper.destroy();
                                        }
                                        this.cropper = new Cropper(this.$refs.cropImage, {
                                            aspectRatio: 1,
                                            viewMode: 1,
                                            background: false, // Menghilangkan background grid
                                            modal: true, // Menambahkan shadow di luar crop box
                                            guides: false, // Menghhilangkan garis guide
                                        });
                                    }, 100);
                                };
                                reader.readAsDataURL(file);
                            },

                            saveCrop() {
                                if (!this.cropper) return;

                                this.isUploading = true;

                                this.cropper.getCroppedCanvas({
                                    width: 400,
                                    height: 400,
                                }).toBlob((blob) => {
                                    @this.upload('avatar', blob, (uploadedFilename) => {
                                        this.closeModal();
                                        this.isUploading = false;
                                        this.$refs.fileInput.value = '';

                                        // Otomatis simpan ke database setelah crop selesai
                                        @this.updateProfile();
                                    }, () => {
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Gagal',
                                            text: 'Gagal mengupload gambar.',
                                            confirmButtonColor: '#d33',
                                        });
                                        this.closeModal();
                                        this.isUploading = false;
                                        this.$refs.fileInput.value = '';
                                    });
                                }, 'image/jpeg', 0.9);
                            },

                            closeModal() {
                                this.showModal = false;
                                if (this.cropper) {
                                    this.cropper.destroy();
                                    this.cropper = null;
                                }
                                this.$refs.fileInput.value = '';
                            }
                        }));
                    });
                </script>
            </div>

            <!-- Right Side: Form -->
            <form wire:submit.prevent="updateProfile" class="flex-1 flex flex-col justify-between py-2 w-full">
                <!-- Wrapper for fields -->
                <div class="space-y-6">

                    <div>
                        <label class="block text-gray-800 font-bold text-lg mb-2">Nama Lengkap</label>
                        <input type="text" wire:model="name" disabled
                            class="w-full border-2 border-gray-300 rounded-md px-4 py-3 text-gray-500 font-medium bg-gray-100 cursor-not-allowed focus:outline-none">
                        @error('name')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-gray-800 font-bold text-lg mb-2">Kelas</label>
                        <div class="relative">
                            <select wire:model="class_id" disabled
                                class="w-full border-2 border-gray-300 rounded-md px-4 py-3 text-gray-500 font-medium appearance-none bg-gray-100 cursor-not-allowed focus:outline-none">
                                <option value="">Pilih Kelas</option>
                                @foreach ($classes as $cls)
                                    <option value="{{ $cls->id }}">{{ $cls->name }}</option>
                                @endforeach
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex flex-col items-center justify-center px-4 text-gray-400">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 15l7-7 7 7"></path>
                                </svg>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('class_id')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>



                    <div>
                        <label class="block text-gray-800 font-bold text-lg mb-2">Jenis Kelamin</label>
                        <div class="relative">
                            <select wire:model="gender" disabled
                                class="w-full border-2 border-gray-300 rounded-md px-4 py-3 text-gray-500 font-medium appearance-none bg-gray-100 cursor-not-allowed focus:outline-none">
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex flex-col items-center justify-center px-4 text-gray-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('gender')
                            <span class="text-red-500 text-xs mt-1">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="bg-[#FF7A00] text-white px-8 py-2.5 rounded text-lg font-bold shadow-md hover:bg-orange-600 transition">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
