<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Get all categories
     */
    public function index()
    {
        $categories = $this->getMockCategories();
        
        return response()->json([
            'success' => true,
            'data' => $categories,
            'message' => 'Categories retrieved successfully'
        ]);
    }

    /**
     * Get a specific category by ID
     */
    public function show($id)
    {
        $categories = $this->getMockCategories();
        
        // Find category by ID
        $category = null;
        foreach ($categories as $cat) {
            if ($cat['id'] == $id) {
                $category = $cat;
                break;
            }
        }

        if (!$category) {
            return response()->json([
                'success' => false,
                'message' => 'Category not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $category,
            'message' => 'Category retrieved successfully'
        ]);
    }

    /**
     * Get products in a specific category
     */
    public function products($id, Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);
        
        $productController = new ProductController();
        $products = $productController->getMockProducts();
        
        // Filter products by category
        $filteredProducts = [];
        foreach ($products as $product) {
            if ($product['category_id'] == $id) {
                $filteredProducts[] = $product;
            }
        }
        
        // Simulate pagination
        $total = count($filteredProducts);
        $lastPage = ceil($total / $perPage);
        $from = ($page - 1) * $perPage + 1;
        $to = min($page * $perPage, $total);
        
        $data = [
            'current_page' => (int)$page,
            'data' => array_slice($filteredProducts, ($page - 1) * $perPage, $perPage),
            'from' => $from,
            'last_page' => $lastPage,
            'per_page' => (int)$perPage,
            'to' => $to,
            'total' => $total
        ];
        
        return response()->json([
            'success' => true,
            'data' => $data,
            'message' => 'Products in category retrieved successfully'
        ]);
    }
    
    /**
     * Get mock categories data
     */
    private function getMockCategories()
    {
        return [
            [
                'id' => 1,
                'code' => 'CAT-COMP',
                'name' => 'Computers',
                'parent_id' => null,
                'slug' => 'computers',
                'image' => 'computer.png',
                'description' => 'All computer products',
                'subcategories' => [
                    [
                        'id' => 2,
                        'name' => 'Laptops',
                        'parent_id' => 1,
                        'slug' => 'laptops',
                        'image' => 'laptop.png',
                        'description' => 'Laptop computers'
                    ],
                    [
                        'id' => 3,
                        'name' => 'Desktops',
                        'parent_id' => 1,
                        'slug' => 'desktops',
                        'image' => 'desktop.png',
                        'description' => 'Desktop computers'
                    ]
                ]
            ],
            [
                'id' => 4,
                'code' => 'CAT-ACC',
                'name' => 'Accessories',
                'parent_id' => null,
                'slug' => 'accessories',
                'image' => 'accessories.png',
                'description' => 'Computer accessories',
                'subcategories' => [
                    [
                        'id' => 5,
                        'name' => 'Keyboards',
                        'parent_id' => 4,
                        'slug' => 'keyboards',
                        'image' => 'keyboard.png',
                        'description' => 'Computer keyboards'
                    ],
                    [
                        'id' => 6,
                        'name' => 'Mice',
                        'parent_id' => 4,
                        'slug' => 'mice',
                        'image' => 'mouse.png',
                        'description' => 'Computer mice'
                    ]
                ]
            ]
        ];
    }
} 