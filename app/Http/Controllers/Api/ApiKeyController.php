<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiKeyController extends Controller
{
    /**
     * Display a listing of the API keys.
     */
    public function index()
    {
        $apiKeys = $this->getMockApiKeys();
        
        return response()->json([
            'success' => true,
            'data' => $apiKeys,
            'message' => 'API keys retrieved successfully'
        ]);
    }

    /**
     * Store a newly created API key in storage.
     */
    public function store(Request $request)
    {
        // In a real application, we would validate input
        // and create a new API key in the database
        
        $mockKey = [
            'id' => 100,
            'name' => $request->input('name', 'New API Key'),
            'key' => 'msk-api-' . substr(md5(uniqid()), 0, 32),
            'created_at' => date('Y-m-d H:i:s'),
            'last_used_at' => null,
            'expires_at' => null,
            'is_active' => true
        ];
        
        return response()->json([
            'success' => true,
            'data' => $mockKey,
            'message' => 'API key created successfully'
        ], 201);
    }

    /**
     * Display the specified API key.
     */
    public function show($id)
    {
        $apiKeys = $this->getMockApiKeys();
        
        // Find API key by ID
        $apiKey = null;
        foreach ($apiKeys as $key) {
            if ($key['id'] == $id) {
                $apiKey = $key;
                break;
            }
        }

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key not found',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $apiKey,
            'message' => 'API key retrieved successfully'
        ]);
    }

    /**
     * Update the specified API key.
     */
    public function update(Request $request, $id)
    {
        $apiKeys = $this->getMockApiKeys();
        
        // Find API key by ID
        $apiKey = null;
        foreach ($apiKeys as &$key) {
            if ($key['id'] == $id) {
                $apiKey = &$key;
                break;
            }
        }

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key not found',
            ], 404);
        }
        
        // Update the API key
        $apiKey['name'] = $request->input('name', $apiKey['name']);
        $apiKey['is_active'] = $request->has('is_active') ? $request->input('is_active') : $apiKey['is_active'];
        $apiKey['expires_at'] = $request->input('expires_at', $apiKey['expires_at']);
        
        return response()->json([
            'success' => true,
            'data' => $apiKey,
            'message' => 'API key updated successfully'
        ]);
    }

    /**
     * Remove the specified API key.
     */
    public function destroy($id)
    {
        $apiKeys = $this->getMockApiKeys();
        
        // Find API key by ID
        $apiKey = null;
        foreach ($apiKeys as $key) {
            if ($key['id'] == $id) {
                $apiKey = $key;
                break;
            }
        }

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key not found',
            ], 404);
        }
        
        return response()->json([
            'success' => true,
            'message' => 'API key deleted successfully'
        ]);
    }

    /**
     * Regenerate the specified API key.
     */
    public function regenerate($id)
    {
        $apiKeys = $this->getMockApiKeys();
        
        // Find API key by ID
        $apiKey = null;
        foreach ($apiKeys as &$key) {
            if ($key['id'] == $id) {
                $apiKey = &$key;
                break;
            }
        }

        if (!$apiKey) {
            return response()->json([
                'success' => false,
                'message' => 'API key not found',
            ], 404);
        }
        
        // Regenerate the API key
        $apiKey['key'] = 'msk-api-' . substr(md5(uniqid()), 0, 32);
        $apiKey['created_at'] = date('Y-m-d H:i:s');
        
        return response()->json([
            'success' => true,
            'data' => $apiKey,
            'message' => 'API key regenerated successfully'
        ]);
    }
    
    /**
     * Get mock API keys data
     */
    private function getMockApiKeys()
    {
        return [
            [
                'id' => 1,
                'name' => 'Default API Key',
                'key' => 'msk-api-5f4dcc3b5aa765d61d8327deb882cf99',
                'created_at' => '2025-04-12 12:00:00',
                'last_used_at' => '2025-04-12 13:45:10',
                'expires_at' => null,
                'is_active' => true
            ],
            [
                'id' => 2,
                'name' => 'Developer API Key',
                'key' => 'msk-api-6a204bd89f3c8348afd5c77c717a097a',
                'created_at' => '2025-04-12 14:30:00',
                'last_used_at' => null,
                'expires_at' => '2025-12-31 23:59:59',
                'is_active' => true
            ],
            [
                'id' => 3,
                'name' => 'Test API Key',
                'key' => 'msk-api-81dc9bdb52d04dc20036dbd8313ed055',
                'created_at' => '2025-04-12 16:15:00',
                'last_used_at' => null,
                'expires_at' => null,
                'is_active' => false
            ]
        ];
    }
}
