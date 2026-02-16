<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Uncomment when you have a Product model:
// use App\Models\Product;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q', '');
        
        // TEMPORARY: Hardcoded results for demo
        $results = [];
        
        // WHEN YOU HAVE DATABASE: Uncomment this
        /*
        if ($query) {
            $results = Product::where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhere('category', 'LIKE', "%{$query}%")
                ->limit(20)
                ->get();
        } else {
            // Show all products if no search query
            $results = Product::limit(20)->get();
        }
        */
        
        return view('search', compact('query', 'results'));
    }
}