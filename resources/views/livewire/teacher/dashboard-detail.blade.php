<div class="max-w-4xl mx-auto p-4 md:p-8 flex flex-col gap-4">
    <div x-data="{ activeAccordion: null }" class="flex flex-col gap-4">

        <!-- Accordion 1: Tujuan Pembelajaran -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden text-gray-900">
            <button @click="activeAccordion = activeAccordion === 1 ? null : 1"
                class="w-full flex items-center justify-between p-5 md:p-6 font-bold text-lg md:text-xl text-left transition-colors hover:bg-gray-50">
                <span>CP / Tujuan Pembelajaran</span>
                <svg x-show="activeAccordion !== 1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="activeAccordion === 1" style="display:none;" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </button>
            <div x-show="activeAccordion === 1" x-collapse x-cloak>
                <div class="px-5 md:px-13 pb-6 pt-1 text-sm md:text-base">
                    <ol class="list-decimal pl-5 space-y-2 text-gray-800">
                        <li>Menjelaskan permasalahan lingkungan yang ada dengan baik dan benar.</li>
                        <li>Menjelaskan penyebab terjadinya permasalahan lingkungan.</li>
                        <li>Menjelaskan dampak permasalahan lingkungan terhadap kehidupan manusia.</li>
                        <li>Memberikan solusi untuk mengatasi permasalahan lingkungan yang ada.</li>
                    </ol>
                </div>
            </div>
        </div>

        <!-- Accordion 2: Bahan Ajar -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden text-gray-900">
            <button @click="activeAccordion = activeAccordion === 2 ? null : 2"
                class="w-full flex items-center justify-between p-5 md:p-6 font-bold text-lg md:text-xl text-left transition-colors hover:bg-gray-50">
                <span>Bahan Ajar</span>
                <svg x-show="activeAccordion !== 2" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-5 h-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                </svg>
                <svg x-show="activeAccordion === 2" style="display:none;" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                    class="w-5 h-5 text-gray-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                </svg>
            </button>
            <div x-show="activeAccordion === 2" x-collapse x-cloak>
                <div class="px-4 md:px-6 pb-6 pt-2" x-data="{ activeSub: null }">
                    <div class="flex flex-col gap-3">

                        <!-- Sub-accordion 1 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            <button @click="activeSub = activeSub === 1 ? null : 1"
                                class="w-full flex items-center justify-between p-4 font-bold text-base text-left hover:bg-gray-50 transition-colors">
                                <span>KEGIATAN 1 : Lingkungan di Sekitar Kita</span>
                                <svg x-show="activeSub !== 1" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg x-show="activeSub === 1" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <div x-show="activeSub === 1" x-collapse x-cloak>
                                <div class="px-4 pb-5 text-sm md:text-base space-y-4">
                                    <p>Hujan deras sering terjadi di berbagai daerah. Namun, mengapa hujan yang sebentar
                                        bisa
                                        menyebabkan banjir?</p>
                                    <p>Apa yang sebenarnya terjadi di lingkungan tersebut?</p>
                                    <p>Ayo tonton video berikut dengan saksama!<br>Perhatikan kondisi lingkungan,
                                        kejadian
                                        yang terjadi, dan dampaknya bagi masyarakat.</p>
                                    <div class="relative w-full max-w-lg aspect-video mx-auto rounded overflow-hidden shadow-sm my-4 group bg-black">
                                        <img src="https://img.youtube.com/vi/h8jOOd6le30/hqdefault.jpg" alt="Video Thumbnail" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                        <a href="https://youtu.be/h8jOOd6le30" target="_blank" class="absolute inset-0 flex items-center justify-center z-10">
                                            <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-8 h-8 ml-1">
                                                    <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                    <div>
                                        <h4 class="font-bold mb-2">Instruksi</h4>
                                        <p class="mb-2">Setelah menonton video, jawablah pertanyaan berikut:</p>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Apa masalah utama yang terjadi pada video tersebut?</li>
                                            <li>Apa saja dampak yang ditimbulkan dari peristiwa tersebut?</li>
                                            <li>Menurut pendapatmu, apa yang menyebabkan kondisi tersebut bisa terjadi?
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-accordion 2 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            <button @click="activeSub = activeSub === 2 ? null : 2"
                                class="w-full flex items-center justify-between p-4 font-bold text-base text-left hover:bg-gray-50 transition-colors">
                                <span>KEGIATAN 2 : Tentukan Benar atau Salah!</span>
                                <svg x-show="activeSub !== 2" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg x-show="activeSub === 2" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <div x-show="activeSub === 2" x-collapse x-cloak>
                                <div class="px-4 pb-5 text-sm md:text-base space-y-4">
                                    <div>
                                        <h4 class="font-bold mb-2">Instruksi</h4>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Bacalah setiap pernyataan dengan cermat.</li>
                                            <li>Tentukan apakah pernyataan tersebut BENAR atau SALAH.</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <h4 class="font-bold mb-2 mt-4">Pertanyaan</h4>
                                        <ol class="list-decimal pl-5 space-y-2">
                                            <li>"Sampah yang dibuang ke sungai dapat menyumbat aliran air"</li>
                                            <li>"Jika selokan di lingkungan rumah tersumbat sampah, maka membersihkannya
                                                dapat membantu mencegah banjir"</li>
                                            <li>"Banjir yang terjadi setelah hujan deras tidak ada hubungannya dengan
                                                kebiasaan manusia membuang sampah"</li>
                                            <li>"Lingkungan yang tampak kotor belum tentu menyebabkan masalah jika tidak
                                                berdampak pada kehidupan manusia"</li>
                                            <li>"Sebagian besar permasalahan lingkungan di sekitar kita terjadi karena
                                                kebiasaan manusia yang tidak menjaga kebersihan lingkungan."</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-accordion 3 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            <button @click="activeSub = activeSub === 3 ? null : 3"
                                class="w-full flex items-center justify-between p-4 font-bold text-base text-left hover:bg-gray-50 transition-colors">
                                <span>KEGIATAN 3 : Ayo Amati Lingkungan Sekitarmu!</span>
                                <svg x-show="activeSub !== 3" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg x-show="activeSub === 3" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <div x-show="activeSub === 3" x-collapse x-cloak>
                                <div class="px-4 pb-5 text-sm md:text-base space-y-4">
                                    <p>Setelah mengetahui permasalahan pada video sebelumnya, sekarang saatnya kamu
                                        melakukan pengamatan langsung di lingkungan sekitarmu. Melalui kegiatan ini,
                                        kamu akan menemukan sendiri kondisi lingkungan serta permasalahan yang mungkin
                                        terjadi di sekitarmu.</p>
                                    <div>
                                        <h4 class="font-bold mb-2 mt-4">Instruksi</h4>
                                        <p class="mb-2">Lakukan kegiatan berikut dengan tertib:</p>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Perhatikan lingkungan di sekitar atau dapat mencarinya di internet.</li>
                                            <li>Pilih tempat yang menurutmu menarik untuk diamati.</li>
                                            <li>Cari gambar di internet atau ambil foto di sekitar kamu kemudian upload
                                                pada bagian gambar.</li>
                                            <li>Jelaskan gambar tersebut.
                                                <ul class="list-disc pl-5 mt-1 space-y-1">
                                                    <li>Jika lingkungan KOTOR (Jelaskan penyebab dan dampak lingkungan
                                                        kotor tersebut dan berikan solusinya)</li>
                                                    <li>Jika Lingkungan BERSIH (Jelaskan mengapa lingkungan tersebut
                                                        tetap bersih dan bagaimana cara menjaga lingkungan tetap bersih)
                                                    </li>
                                                </ul>
                                            </li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-accordion 4 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            <button @click="activeSub = activeSub === 4 ? null : 4"
                                class="w-full flex items-center justify-between p-4 font-bold text-base text-left hover:bg-gray-50 transition-colors">
                                <span>KEGIATAN 4 : Mengapa Terjadi & Bagaimana Solusinya?</span>
                                <svg x-show="activeSub !== 4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg x-show="activeSub === 4" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <div x-show="activeSub === 4" x-collapse x-cloak>
                                <div class="px-4 pb-5 text-sm md:text-base space-y-4">
                                    <p>Kamu telah mengamati lingkungan di sekitarmu dan menemukan berbagai kondisi yang
                                        terjadi.</p>
                                    <p>Sekarang, mari kita analisis bersama untuk memahami penyebab permasalahan
                                        tersebut dan menentukan solusi yang dapat dilakukan.</p>
                                    <div>
                                        <h4 class="font-bold mb-2 mt-4">Instruksi</h4>
                                        <p class="mb-2">Perhatikan kembali hasil pengamatanmu!</p>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Apa persamaan masalah yang kamu temukan dengan peristiwa pada video
                                                sebelumnya?</li>
                                        </ol>
                                    </div>
                                    <div>
                                        <p class="mb-2 mt-4">Perhatikan video berikut untuk melihat penjelasan tentang
                                            penyebab dan solusi permasalahan lingkungan.</p>
                                        <div class="relative w-full max-w-lg aspect-video mx-auto rounded overflow-hidden shadow-sm my-4 group bg-black">
                                            <img src="https://img.youtube.com/vi/tVbu49X0aus/hqdefault.jpg" alt="Video Thumbnail" class="absolute inset-0 w-full h-full object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                                            <a href="https://youtu.be/tVbu49X0aus" target="_blank" class="absolute inset-0 flex items-center justify-center z-10">
                                                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="white" class="w-8 h-8 ml-1">
                                                        <path fill-rule="evenodd" d="M4.5 5.653c0-1.426 1.529-2.33 2.779-1.643l11.54 6.348c1.295.712 1.295 2.573 0 3.285L7.28 19.991c-1.25.687-2.779-.217-2.779-1.643V5.653z" clip-rule="evenodd" />
                                                    </svg>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="font-bold mb-2 mt-4">Instruksi</h4>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Apa solusi yang dapat kamu lakukan untuk mengatasi permasalahan
                                                lingkungan di sekitarmu jika lingkungan tersebut kotor atau rusak?
                                                mengapa solusi tersebut penting dilakukan?</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sub-accordion 5 -->
                        <div class="bg-white rounded-xl border border-gray-200 overflow-hidden shadow-sm">
                            <button @click="activeSub = activeSub === 5 ? null : 5"
                                class="w-full flex items-center justify-between p-4 font-bold text-base text-left hover:bg-gray-50 transition-colors">
                                <span>KEGIATAN 5 : Ayo Lakukan Refleksi</span>
                                <svg x-show="activeSub !== 5" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                                <svg x-show="activeSub === 5" style="display:none" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                    class="w-4 h-4 text-gray-400 shrink-0">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                </svg>
                            </button>
                            <div x-show="activeSub === 5" x-collapse x-cloak>
                                <div class="px-4 pb-5 text-sm md:text-base space-y-4">
                                    <div>
                                        <h4 class="font-bold mb-2">Instruksi</h4>
                                        <ol class="list-decimal pl-5 space-y-1">
                                            <li>Apa hal baru yang kamu pelajari hari ini?</li>
                                            <li>Mengapa menjaga lingkungan itu penting?</li>
                                            <li>Apa yang akan kamu lakukan mulai sekarang untuk menjaga lingkungan?</li>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
