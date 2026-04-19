<div class="px-6 py-12 md:px-12 md:py-16 max-w-5xl mx-auto flex items-center justify-center min-h-[85vh]">

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('profile-updated', (event) => {
                let msg = event.message || (event[0] && event[0].message) ||
                    'Profil berhasil diperbarui!';
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: msg,
                    confirmButtonColor: '#FF7A00'
                });
            });
        });
    </script>

    <!-- Main Profile Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-8 md:p-14 relative w-full flex items-center justify-center">

        <div class="w-full flex flex-col md:flex-row gap-12 md:gap-24 items-start m-auto justify-center">

            <!-- Left Side: Avatar -->
            <div x-data="avatarCrop()" class="flex flex-col items-center shrink-0 pt-4 w-full md:w-auto">

                <link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.css" rel="stylesheet">
                <script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.6.1/cropper.min.js"></script>

                <div class="relative w-48 h-48 sm:w-56 sm:h-56 md:w-64 md:h-64 bg-[#D9D9D9] rounded-full overflow-hidden mb-6 flex items-center justify-center">
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
                        <svg class="animate-spin h-8 w-8 text-orange-500" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor"
                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                            </path>
                        </svg>
                    </div>
                </div>

                <button type="button" @click="$refs.fileInput.click()"
                    class="bg-[#D9D9D9] hover:bg-gray-300 text-black font-bold py-1.5 px-4 rounded shadow-sm text-xs md:text-sm flex items-center gap-1.5 transition">
                    Ganti Gambar
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-black" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                </button>

                <input type="file" x-ref="fileInput" @change="onFileChange" class="hidden" accept="image/*">
                @error('avatar')
                    <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
                @enderror

                <!-- Crop Modal -->
                <div x-show="showModal" style="display: none;"
                    class="fixed inset-0 z-[9999] overflow-y-auto flex items-center justify-center"
                    aria-labelledby="modal-title" role="dialog" aria-modal="true">

                    <div x-show="showModal" x-transition.opacity
                        class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" aria-hidden="true">
                    </div>

                    <div x-show="showModal" x-transition
                        class="relative bg-white rounded-xl shadow-2xl text-left overflow-hidden transform transition-all sm:my-8 sm:max-w-lg w-full mx-4 border border-gray-100 z-50">
                        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                            <div class="mt-3 text-center sm:mt-0 sm:text-left w-full">
                                <h3 class="text-lg leading-6 font-bold text-gray-900 mb-4" id="modal-title">Sesuaikan Custom Avatar (1:1)</h3>
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
                                        text: 'Ukuran file melebihi 1MB!',
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
                                            background: false,
                                            modal: true,
                                            guides: false,
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

                                        // Disconnect auto-save from image change, only store in temporary until hitting explicit 'Update' button
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
            <form wire:submit.prevent="updateProfile" class="flex-1 flex flex-col justify-between py-2 w-full md:max-w-md">
                
                <div class="space-y-4">
                    
                    <div>
                        <label class="block text-gray-800 font-bold text-sm md:text-base mb-1.5">Nama Lengkap</label>
                        <input type="text" wire:model="name"
                            class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-orange-500 bg-white">
                        @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-800 font-bold text-sm md:text-base mb-1.5">Nama Pengguna</label>
                        <input type="text" wire:model="username"
                            class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-orange-500 bg-white">
                        @error('username') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-800 font-bold text-sm md:text-base mb-1.5">Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-orange-500 bg-white">
                        @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-gray-800 font-bold text-sm md:text-base mb-1.5">Sekolah</label>
                        <input type="text" wire:model="school"
                            class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-orange-500 bg-white">
                        @error('school') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div x-data="{ showPw: false }">
                        <label class="block text-gray-800 font-bold text-sm md:text-base mb-1.5">Kata Sandi</label>
                        <div class="relative">
                            <input :type="showPw ? 'text' : 'password'" wire:model="password" placeholder="********"
                                class="w-full border border-gray-400 rounded-md px-4 py-2.5 text-gray-700 font-medium focus:outline-none focus:ring-1 focus:ring-orange-500 bg-white placeholder-gray-400">
                            
                            <!-- Toggle Eye -->
                            <button type="button" @click="showPw = !showPw" class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-500 hover:text-gray-700">
                                <svg x-show="!showPw" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                                </svg>
                                <svg x-show="showPw" style="display: none;" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 border-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        @error('password') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="bg-[#FF7A00] text-white px-8 py-2 md:py-2 rounded text-base font-bold shadow-md hover:bg-orange-600 transition tracking-wide">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
