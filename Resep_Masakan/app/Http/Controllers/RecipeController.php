<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('search');
        
        // Ambil data dari JSON lokal untuk resep Indonesia
        $json = file_get_contents(public_path('indonesian_recipes.json'));
        $recipes = json_decode($json, true)['meals'] ?? [];
        
        // Jika ada pencarian, filter array secara lokal (case-insensitive)
        if ($query) {
            $recipes = array_filter($recipes, function($recipe) use ($query) {
                return stripos($recipe['strMeal'], $query) !== false;
            });
        }
        
        // Urutkan resep sesuai abjad A-Z berdasarkan nama resep
        usort($recipes, function($a, $b) {
            return strcmp($a['strMeal'], $b['strMeal']);
        });
        
        // Re-index array
        $recipes = array_values($recipes);
        
        return view('recipes.index', compact('recipes', 'query'));
    }

    public function show($id)
    {
        // Cari resep berdasarkan ID dari JSON lokal
        $json = file_get_contents(public_path('indonesian_recipes.json'));
        $allRecipes = json_decode($json, true)['meals'] ?? [];
        
        $recipe = null;
        foreach ($allRecipes as $r) {
            if ($r['idMeal'] == $id) {
                $recipe = $r;
                break;
            }
        }

        if (!$recipe) {
            abort(404, 'Recipe not found');
        }

        // Check if premium
        $isPremium = auth()->check() && auth()->user()->isPremium();

        if (!$isPremium) {
            return redirect()->route('subscribe')->with('error', 'Silakan berlangganan terlebih dahulu untuk mengakses resep lengkap.');
        }

        return view('recipes.show', compact('recipe'));
    }
}
