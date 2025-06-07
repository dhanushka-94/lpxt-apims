<?php

namespace App\Console\Commands;

use App\Models\ApiKey;
use Illuminate\Console\Command;

class RemoveApiKeyExpiration extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'api:key:no-expiration {key}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove expiration from an API key';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $key = $this->argument('key');
        
        $apiKey = ApiKey::where('key', $key)->first();
        
        if (!$apiKey) {
            $this->error('API Key not found!');
            return 1;
        }
        
        $apiKey->expires_at = null;
        $apiKey->save();
        
        $this->info('API key expiration removed successfully.');
        $this->table(
            ['Name', 'API Key', 'Expires At'],
            [[$apiKey->name, $apiKey->key, 'Never']]
        );
        
        return 0;
    }
}
