<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = 'sma_attributes';
    protected $primaryKey = 'id';
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'code',
        'description',
        'type'
    ];
    
    /**
     * Get products that have this attribute
     */
    public function products()
    {
        return $this->hasManyThrough(
            Product::class, 
            ProductAttribute::class,
            'attribute_id', // Foreign key on ProductAttribute
            'id', // Foreign key on Product
            'id', // Local key on Attribute
            'product_id' // Local key on ProductAttribute
        );
    }
} 