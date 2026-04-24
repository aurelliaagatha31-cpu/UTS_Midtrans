<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->name }}!</h3>
                    
                    @if(Auth::user()->isPremium())
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded mb-4" role="alert">
                            <p class="font-bold">Status Anda: Premium <i data-lucide="crown" class="inline-block w-5 h-5 ml-1"></i></p>
                            <p>Langganan Anda aktif hingga: {{ Auth::user()->subscription_ends_at->format('d M Y, H:i') }}</p>
                        </div>
                        <p class="mt-4">
                            <a href="{{ route('home') }}" class="text-blue-600 hover:underline">Lihat daftar resep premium sekarang &rarr;</a>
                        </p>
                    @else
                        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 rounded mb-6">
                            <div class="flex">
                                <div class="flex-shrink-0">
                                    <i data-lucide="info" class="h-5 w-5 text-yellow-400"></i>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm text-yellow-700">
                                        Anda saat ini menggunakan akun gratis. Tingkatkan ke Premium untuk membuka semua resep lengkap dan instruksi masakan eksklusif.
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('subscribe') }}" class="inline-flex items-center px-4 py-2 bg-orange-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-orange-700 focus:bg-orange-700 active:bg-orange-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow">
                            Berlangganan Premium Sekarang
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
