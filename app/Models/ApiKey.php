<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ApiKey extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'key',
        'description',
        'expires_at',
        'is_active',
        'last_used_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    /**
     * Generate a new API key
     */
    public static function generateKey(): string
    {
        return Str::random(64);
    }

    /**
     * Check if the API key is valid
     */
    public function isValid(): bool
    {
        // Key must be active
        if (!$this->is_active) {
            return false;
        }

        // Key must not be expired
        if ($this->expires_at && $this->expires_at->isPast()) {
            return false;
        }

        return true;
    }

    /**
     * Update the last used timestamp
     */
    public function markAsUsed(): self
    {
        $this->update(['last_used_at' => now()]);
        return $this;
    }
}
