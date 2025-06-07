<?php

namespace App\Console\Commands;

use App\Models\ApiKey;
use Carbon\Carbon;
use Illuminate\Console\Command;

class GenerateApiKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:key:generate
                            {name : The name of the API key}
                            {--description= : Optional description for the API key}
                            {--expires= : Optional expiration date in days}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new API key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name');
        $description = $this->option('description');
        $expiresInDays = $this->option('expires');

        $expiresAt = null;
        if ($expiresInDays) {
            $expiresAt = Carbon::now()->addDays((int) $expiresInDays);
        }

        // Generate a unique API key
        $key = ApiKey::generateKey();

        // Create the API key in the database
        $apiKey = ApiKey::create([
            'name' => $name,
            'key' => $key,
            'description' => $description,
            'expires_at' => $expiresAt,
            'is_active' => true,
        ]);

        $this->info('API key generated successfully!');
        $this->table(
            ['Name', 'API Key', 'Expires At'],
            [[$apiKey->name, $apiKey->key, $apiKey->expires_at ? $apiKey->expires_at->format('Y-m-d H:i:s') : 'Never']]
        );

        $this->line('');
        $this->info('Use this key in your API requests with the header:');
        $this->line("X-API-KEY: {$apiKey->key}");
        $this->line('');
        $this->info('Or as a query parameter:');
        $this->line("?api_key={$apiKey->key}");
    }
}
