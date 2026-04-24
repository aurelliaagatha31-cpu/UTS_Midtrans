<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-orange-600 tracking-wide leading-tight flex items-center gap-2">
            <i data-lucide="chef-hat" class="w-8 h-8"></i> {{ __('DapurKita') }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen pb-12">
        <!-- Hero Section -->
        <div class="relative bg-gradient-to-br from-amber-500 via-orange-500 to-red-600 text-white overflow-hidden shadow-2xl rounded-b-[3rem] mx-4 sm:mx-8 mt-4">
            <div class="absolute inset-0 bg-black opacity-10 bg-[url('https://www.transparenttextures.com/patterns/food.png')]"></div>
            <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-md border border-white/30 text-orange-50 text-sm font-semibold tracking-wider mb-6 animate-pulse">
                    Mengeksplorasi Rasa, Merawat Tradisi
                </span>
                <h1 class="text-5xl md:text-7xl font-extrabold tracking-tight mb-6 drop-shadow-lg font-serif">
                    Kelezatan Resep Nusantara
                </h1>
                <p class="mt-4 max-w-2xl text-lg md:text-2xl text-orange-50 mx-auto mb-12 drop-shadow font-light">
                    Temukan inspirasi memasak hari ini. Dari hidangan rumahan hingga sajian istimewa, semua ada di <span class="font-bold">DapurKita</span>.
                </p>
                
                <div class="max-w-2xl mx-auto">
                    <form action="{{ route('home') }}" method="GET" class="relative flex items-center group">
                        <i data-lucide="search" class="absolute left-6 text-gray-400 w-6 h-6 group-focus-within:text-orange-500 transition-colors"></i>
                        <input type="text" name="search" class="w-full pl-16 pr-36 py-5 rounded-full text-gray-900 border-none focus:outline-none focus:ring-4 focus:ring-orange-300 shadow-2xl text-lg transition duration-300 bg-white/95 backdrop-blur-sm" placeholder="Mau masak apa hari ini? (contoh: Rendang)..." value="{{ $query ?? '' }}">
                        <button type="submit" class="absolute right-3 px-8 py-3 bg-gradient-to-r from-orange-600 to-red-600 hover:from-orange-500 hover:to-red-500 text-white font-bold rounded-full transition-all duration-300 shadow-lg transform hover:scale-105 active:scale-95 flex items-center gap-2">
                            Cari Resep
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- Decorative shapes -->
            <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white opacity-10 rounded-full blur-2xl"></div>
            <div class="absolute top-10 -right-10 w-60 h-60 bg-yellow-300 opacity-10 rounded-full blur-3xl"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-12">
            @if($query && !empty($recipes))
                <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-l-4 border-orange-500 pl-3">
                    Search results for <span class="text-orange-600 ml-2">"{{ $query }}"</span>
                </h3>
            @elseif($query && empty($recipes))
                <!-- Handled below -->
            @else
                <h3 class="text-3xl font-bold text-gray-800 mb-8 flex items-center border-l-4 border-orange-500 pl-3">
                    Resep Populer Indonesia
                </h3>
            @endif

            @if(empty($recipes))
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-16 text-center max-w-2xl mx-auto mt-10">
                    <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-orange-100 text-orange-500 mb-6">
                        <i data-lucide="frown" class="w-12 h-12"></i>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">No recipes found</h2>
                    <p class="text-gray-500 text-lg mb-8">We couldn't find any recipes matching <span class="font-semibold text-gray-700">"{{ $query }}"</span>. Please try another search term.</p>
                    <a href="{{ route('home') }}" class="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-full text-gray-700 bg-white hover:bg-gray-50 hover:text-orange-600 transition duration-300 shadow-sm">
                        Clear Search
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($recipes as $index => $recipe)
                        <a href="{{ route('recipe.show', $recipe['idMeal']) }}" class="group bg-white rounded-[2rem] overflow-hidden shadow-sm hover:shadow-2xl hover:-translate-y-3 transition-all duration-500 border border-gray-100 flex flex-col relative z-10">
                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-in-out" loading="lazy">
                                <div class="absolute top-4 left-4 flex gap-2 z-20">
                                    <span class="bg-white/95 backdrop-blur-md text-orange-600 text-xs tracking-wider uppercase font-bold px-4 py-1.5 rounded-full shadow-lg border border-white/20">
                                        {{ $recipe['strCategory'] ?? 'Indonesian' }}
                                    </span>
                                </div>
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/90 via-gray-900/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                                
                                @php
                                    $isPremium = auth()->check() && auth()->user()->isPremium();
                                @endphp
                                
                                <!-- Hover overlay button -->
                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-500 z-20">
                                    <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white font-bold py-3 px-6 rounded-full transform translate-y-4 group-hover:translate-y-0 transition-all duration-500 shadow-xl flex items-center gap-2">
                                        @if($isPremium)
                                            Lihat Resep <i data-lucide="unlock" class="w-4 h-4"></i>
                                        @else
                                            Akses Premium <i data-lucide="lock" class="w-4 h-4"></i>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            <div class="p-6 flex flex-col flex-grow relative bg-white">
                                <!-- Decorative icon -->
                                <div class="absolute -top-6 right-6 w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-lg border border-gray-50 z-30 group-hover:rotate-12 transition-transform duration-300 {{ $isPremium ? 'text-green-500' : 'text-orange-500' }}">
                                    @if($isPremium)
                                        <i data-lucide="check-circle-2" class="w-6 h-6"></i>
                                    @else
                                        <i data-lucide="lock" class="w-6 h-6"></i>
                                    @endif
                                </div>
                                
                                <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-orange-600 transition-colors pt-2">{{ $recipe['strMeal'] }}</h3>
                                <div class="flex items-center text-gray-500 text-sm mt-auto mb-5 bg-gray-50 py-2 px-3 rounded-xl w-fit">
                                    <i data-lucide="map-pin" class="w-4 h-4 mr-2 text-orange-500"></i>
                                    {{ $recipe['strArea'] ?? 'Indonesian' }} Culinary
                                </div>
                                <div class="border-t border-gray-100 pt-5 flex items-center justify-between">
                                    <div class="flex items-center gap-2 text-gray-400 text-xs">
                                        <i data-lucide="clock" class="w-4 h-4"></i> 45 Min
                                        <span class="mx-1">•</span>
                                        <i data-lucide="flame" class="w-4 h-4"></i> Sedang
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
