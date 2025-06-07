<?php

namespace Database\Seeders;

use App\Models\ApiKey;
use Illuminate\Database\Seeder;

class ApiKeySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a default API key for testing
        ApiKey::create([
            'name' => 'Default API Key',
            'key' => 'msk-api-' . md5('mskcomputers' . time()),
            'description' => 'Default API key for testing purposes',
            'expires_at' => null, // Never expires
            'is_active' => true,
        ]);

        $this->command->info('Default API key created successfully!');
    }
} 