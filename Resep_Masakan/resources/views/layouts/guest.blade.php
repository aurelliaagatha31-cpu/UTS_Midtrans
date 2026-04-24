<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts (CDN fallback since Vite is not built) -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gradient-to-br from-amber-100 via-orange-50 to-orange-100 relative overflow-hidden">
            <!-- Decorative Background Pattern -->
            <div class="absolute inset-0 opacity-5 bg-[url('https://www.transparenttextures.com/patterns/food.png')]"></div>
            
            <div class="absolute -top-32 -left-32 w-96 h-96 bg-orange-300 opacity-20 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-red-300 opacity-20 rounded-full blur-3xl"></div>

            <div class="relative z-10 flex flex-col items-center">
                <a href="/" class="flex items-center gap-3 text-orange-600 hover:text-orange-700 transition-colors">
                    <div class="w-16 h-16 bg-white rounded-full flex items-center justify-center shadow-xl border border-orange-100">
                        <!-- Use lucide directly if loaded, or SVG -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chef-hat"><path d="M17 21a1 1 0 0 0 1-1v-5.35c0-.457.315-.844.752-.96 2.05-.544 3.248-2.589 2.22-4.576a3.5 3.5 0 0 0-5.748-1.026 3.5 3.5 0 0 0-6.448 0 3.5 3.5 0 0 0-5.748 1.026c-1.028 1.987.17 4.032 2.22 4.576.437.116.752.503.752.96V20a1 1 0 0 0 1 1Z"/><path d="M7 4h.01"/><path d="M17 4h.01"/></svg>
                    </div>
                    <span class="text-3xl font-bold tracking-tight font-serif">DapurKita</span>
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-8 px-8 py-8 bg-white/80 backdrop-blur-xl shadow-2xl overflow-hidden sm:rounded-[2rem] border border-white relative z-10">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
