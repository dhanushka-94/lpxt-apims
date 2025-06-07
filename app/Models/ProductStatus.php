<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductStatus extends Model
{
    use HasFactory;

    protected $table = 'sma_product_status';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Define relationships
    public function products()
    {
        return $this->hasMany(Product::class, 'product_status', 'id');
    }
} 