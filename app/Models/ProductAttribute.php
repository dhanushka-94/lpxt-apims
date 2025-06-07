<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $table = 'sma_product_attributes';
    protected $primaryKey = 'id';
    protected $fillable = ['product_id', 'attribute_id', 'value', 'status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }
} 