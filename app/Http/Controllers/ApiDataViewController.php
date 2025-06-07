<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ApiDataViewController extends Controller
{
    /**
     * Display a list of all API data in a table format
     */
    public function index(Request $request)
    {
        $categoryId = $request->input('category_id');
        $perPage = $request->input('per_page', 15);
        $query = $request->input('query');
        
        // Query the products with category and brand
        $productsQuery = Product::with(['category', 'brand', 'photos', 'status']);
        
        // Apply filters if provided
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
        
        if ($query) {
            $productsQuery->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('code', 'like', "%{$query}%")
                  ->orWhere('second_name', 'like', "%{$query}%");
            });
        }
        
        // Get the paginated results
        $products = $productsQuery->paginate($perPage);
        
        // Get all categories for the filter dropdown
        $categories = Category::all();
        
        return view('api.data-view', [
            'products' => $products,
            'categories' => $categories,
            'categoryId' => $categoryId,
            'query' => $query
        ]);
    }
} 