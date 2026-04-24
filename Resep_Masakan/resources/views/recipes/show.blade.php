<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            {{ $recipe['strMeal'] }}
        </h2>
    </x-slot>

    <div class="bg-gray-50 min-h-screen py-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <a href="{{ route('home') }}" class="inline-flex items-center text-gray-500 hover:text-orange-600 transition-colors mb-6 font-medium">
                <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i>
                Back to Recipes
            </a>

            <!-- Premium Banner -->
            <div class="bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-2xl shadow-md p-1 mb-8 flex items-center justify-between text-white overflow-hidden relative">
                <div class="absolute right-0 top-0 opacity-10">
                    <i data-lucide="star" class="w-32 h-32 -mt-10 -mr-10 text-white fill-current"></i>
                </div>
                <div class="px-6 py-3 flex items-center z-10">
                    <i data-lucide="crown" class="w-6 h-6 mr-3 text-yellow-100"></i>
                    <span class="font-bold text-lg">Premium Recipe Unlocked!</span>
                </div>
                <div class="px-6 py-3 z-10 hidden sm:block">
                    <span class="text-sm text-yellow-100 opacity-90">Enjoy your exclusive cooking experience.</span>
                </div>
            </div>

            <!-- Recipe Header Card -->
            <div class="bg-white rounded-3xl shadow-xl overflow-hidden mb-10 flex flex-col md:flex-row border border-gray-100">
                <div class="md:w-1/2 relative h-80 md:h-auto">
                    <img src="{{ $recipe['strMealThumb'] }}" alt="{{ $recipe['strMeal'] }}" class="absolute inset-0 w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                    <div class="absolute bottom-6 left-6 right-6 text-white">
                        <h1 class="text-3xl md:text-5xl font-extrabold mb-3 drop-shadow-lg">{{ $recipe['strMeal'] }}</h1>
                        <div class="flex flex-wrap gap-2">
                            @if(!empty($recipe['strCategory']))
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-500/80 backdrop-blur-sm text-sm font-semibold">
                                <i data-lucide="folder" class="w-4 h-4 mr-1.5"></i>
                                {{ $recipe['strCategory'] }}
                            </span>
                            @endif
                            @if(!empty($recipe['strArea']))
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-blue-500/80 backdrop-blur-sm text-sm font-semibold">
                                <i data-lucide="map-pin" class="w-4 h-4 mr-1.5"></i>
                                {{ $recipe['strArea'] }}
                            </span>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="md:w-1/2 p-8 lg:p-12 flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                        <i data-lucide="info" class="w-6 h-6 mr-2 text-orange-500"></i> Recipe Details
                    </h3>
                    
                    <div class="space-y-4 mb-8">
                        @if(!empty($recipe['strTags']))
                            <div class="flex flex-wrap gap-2">
                                @foreach(explode(',', $recipe['strTags']) as $tag)
                                    <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-sm font-medium border border-gray-200">#{{ trim($tag) }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    
                    <div class="flex flex-col sm:flex-row gap-4 mt-auto">
                        @if(!empty($recipe['strYoutube']))
                            <a href="{{ $recipe['strYoutube'] }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex justify-center items-center px-6 py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition duration-300 shadow-md hover:shadow-lg">
                                <i data-lucide="youtube" class="w-5 h-5 mr-2"></i>
                                Watch Tutorial
                            </a>
                        @endif
                        
                        @if(!empty($recipe['strSource']))
                            <a href="{{ $recipe['strSource'] }}" target="_blank" rel="noopener noreferrer" class="flex-1 inline-flex justify-center items-center px-6 py-4 bg-white border-2 border-gray-200 hover:border-gray-300 text-gray-700 hover:text-gray-900 font-bold rounded-xl transition duration-300">
                                <i data-lucide="external-link" class="w-5 h-5 mr-2 text-gray-400"></i>
                                Source Article
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Content Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                
                <!-- Ingredients Column -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-3xl shadow-lg p-8 border border-gray-100 sticky top-8">
                        <h3 class="text-2xl font-bold text-gray-800 mb-6 flex items-center border-b border-gray-100 pb-4">
                            <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-500 flex items-center justify-center mr-3">
                                <i data-lucide="list-checks" class="w-5 h-5"></i>
                            </div>
                            Ingredients
                        </h3>
                        
                        <ul class="space-y-3">
                            @for($i = 1; $i <= 20; $i++)
                                @if(!empty($recipe['strIngredient'.$i]) && trim($recipe['strIngredient'.$i]) !== '')
                                    <li class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-xl transition-colors border border-transparent hover:border-gray-100">
                                        <div class="flex items-center">
                                            <div class="w-2 h-2 rounded-full bg-orange-400 mr-3"></div>
                                            <span class="font-medium text-gray-800">{{ $recipe['strIngredient'.$i] }}</span>
                                        </div>
                                        <span class="text-gray-500 text-sm font-semibold bg-gray-100 px-3 py-1 rounded-full">{{ $recipe['strMeasure'.$i] }}</span>
                                    </li>
                                @endif
                            @endfor
                        </ul>
                    </div>
                </div>
                
                <!-- Instructions Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-3xl shadow-lg p-8 md:p-12 border border-gray-100">
                        <h3 class="text-2xl font-bold text-gray-800 mb-8 flex items-center border-b border-gray-100 pb-4">
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-500 flex items-center justify-center mr-3">
                                <i data-lucide="book-open" class="w-5 h-5"></i>
                            </div>
                            Cooking Instructions
                        </h3>
                        
                        <div class="prose prose-lg max-w-none text-gray-600 leading-relaxed">
                            @php
                                // Better formatting for instructions by splitting on newlines or periods
                                $instructions = $recipe['strInstructions'];
                                $paragraphs = explode("\r\n\r\n", $instructions);
                            @endphp
                            
                            <div class="space-y-6">
                                @foreach($paragraphs as $index => $paragraph)
                                    @if(trim($paragraph) !== '')
                                        <div class="flex gap-4">
                                            <div class="flex-shrink-0 mt-1">
                                                <div class="w-8 h-8 rounded-full bg-gray-100 text-gray-500 font-bold flex items-center justify-center text-sm border border-gray-200">
                                                    {{ $index + 1 }}
                                                </div>
                                            </div>
                                            <p class="pt-1 text-gray-700">{!! nl2br(e(trim($paragraph))) !!}</p>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
