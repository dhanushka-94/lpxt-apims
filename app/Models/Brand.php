<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'sma_brands';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class, 'brand');
    }
} 