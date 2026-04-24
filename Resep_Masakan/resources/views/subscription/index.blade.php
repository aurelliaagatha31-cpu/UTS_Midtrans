<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Akses Resep Premium') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg text-center p-8">
                <h3 class="text-2xl font-bold mb-4">Akses Resep Premium</h3>
                <p class="text-gray-600 mb-8">
                    Dapatkan akses tidak terbatas ke semua resep rahasia dan instruksi memasak lengkap dari para chef terkenal.
                </p>

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                        <span class="block sm:inline">{{ session('error') }}</span>
                    </div>
                @endif

                <div class="relative max-w-sm mx-auto mb-10 group">
                    <!-- Glow effect -->
                    <div class="absolute -inset-1 bg-gradient-to-r from-amber-400 to-orange-600 rounded-2xl blur opacity-25 group-hover:opacity-60 transition duration-1000 group-hover:duration-200"></div>
                    
                    <div class="relative bg-white rounded-2xl ring-1 ring-gray-200 shadow-xl overflow-hidden transform transition-all duration-300 hover:-translate-y-2">
                        <div class="bg-gradient-to-r from-amber-500 to-orange-500 p-6 text-white relative overflow-hidden">
                            <!-- Decorative background -->
                            <div class="absolute top-0 right-0 -mt-4 -mr-4 w-24 h-24 bg-white opacity-10 rounded-full blur-xl"></div>
                            <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-20 h-20 bg-black opacity-10 rounded-full blur-lg"></div>
                            
                            <h4 class="text-xl font-bold uppercase tracking-widest relative z-10 flex items-center justify-center gap-2">
                                <i data-lucide="crown" class="w-5 h-5"></i> DapurKita Premium
                            </h4>
                            <p class="text-orange-50 text-sm mt-1 opacity-90 relative z-10">Akses Tanpa Batas 30 Hari</p>
                        </div>
                        
                        <div class="p-8 bg-white/50 backdrop-blur-sm">
                            <div class="flex justify-center items-baseline mb-6 text-gray-900">
                                <span class="text-3xl font-bold">Rp</span>
                                <span class="text-5xl font-extrabold tracking-tight">50<span class="text-3xl">.000</span></span>
                                <span class="ml-1 text-xl text-gray-500 font-medium">/bln</span>
                            </div>
                            
                            <ul class="text-left text-gray-700 mb-8 space-y-4 font-medium">
                                <li class="flex items-center">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                    </div>
                                    Akses ke <span class="font-bold text-orange-600 ml-1">Semua Resep Rahasia</span>
                                </li>
                                <li class="flex items-center">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                    </div>
                                    Instruksi Masak Langkah-demi-Langkah
                                </li>
                                <li class="flex items-center">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                    </div>
                                    Tips & Trik Dapur Profesional
                                </li>
                                <li class="flex items-center">
                                    <div class="flex-shrink-0 w-6 h-6 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <i data-lucide="check" class="w-4 h-4 text-green-600"></i>
                                    </div>
                                    Pengalaman Bebas Iklan
                                </li>
                            </ul>
                            
                            @auth
                                <form action="{{ route('subscribe.checkout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg transform hover:scale-105 active:scale-95 flex justify-center items-center gap-2">
                                        Mulai Berlangganan <i data-lucide="arrow-right" class="w-5 h-5"></i>
                                    </button>
                                </form>
                            @else
                                <a href="{{ route('subscribe.login') }}" class="w-full bg-gray-900 hover:bg-black text-white font-bold py-4 px-6 rounded-xl transition-all duration-300 shadow-lg transform hover:scale-105 active:scale-95 flex justify-center items-center gap-2">
                                    Login untuk Berlangganan <i data-lucide="log-in" class="w-5 h-5"></i>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>

                <p class="text-gray-500 text-sm">
                    * Pembayaran dapat dilakukan melalui Virtual Account (BCA, Mandiri, BNI, dll), GoPay, OVO, dan Kartu Kredit.
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
