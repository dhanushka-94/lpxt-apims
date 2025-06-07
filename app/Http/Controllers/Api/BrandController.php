<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Get all brands
     */
    public function index()
    {
        $brands = $this->getMockBrands();
        
        return response()->json([
            'success' => true,
            'data' => $brands,
            'message' => 'Brands retrieved successfully'
        ]);
    }

    /**
     * Get a specific brand by ID
     */
    public function show($id)
    {
        $brands = $this->getMockBrands();
        
        // Find brand by ID
        $brand = null;
        foreach ($brands as $b) {
            if ($b['id'] == $id) {
                $brand = $b;
                break;
            }
        }

        if (!$brand) {
            return response()->json([
                'success' => false,
                'message' => 'Brand not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $brand,
            'message' => 'Brand retrieved successfully'
        ]);
    }

    /**
     * Get products for a specific brand
     */
    public function products($id, Request $request)
    {
        $perPage = $request->input('per_page', 15);
        $page = $request->input('page', 1);
        
        $productController = new ProductController();
        $products = $productController->getMockProducts();
        
        // Filter products by brand
        $filteredProducts = [];
        foreach ($products as $product) {
            if ($product['brand']['id'] == $id) {
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
            'message' => 'Products from brand retrieved successfully'
        ]);
    }
    
    /**
     * Get mock brands data
     */
    private function getMockBrands()
    {
        return [
            [
                'id' => 1,
                'code' => 'BR-DELL',
                'name' => 'Dell',
                'image' => 'dell.png',
                'slug' => 'dell',
                'description' => 'Dell Computer Products'
            ],
            [
                'id' => 2,
                'code' => 'BR-HP',
                'name' => 'HP',
                'image' => 'hp.png',
                'slug' => 'hp',
                'description' => 'HP Computer Products'
            ],
            [
                'id' => 3,
                'code' => 'BR-LENOVO',
                'name' => 'Lenovo',
                'image' => 'lenovo.png',
                'slug' => 'lenovo',
                'description' => 'Lenovo Computer Products'
            ],
            [
                'id' => 4,
                'code' => 'BR-APPLE',
                'name' => 'Apple',
                'image' => 'apple.png',
                'slug' => 'apple',
                'description' => 'Apple Computer Products'
            ],
            [
                'id' => 5,
                'code' => 'BR-ASUS',
                'name' => 'Asus',
                'image' => 'asus.png',
                'slug' => 'asus',
                'description' => 'Asus Computer Products'
            ]
        ];
    }
} 