<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'sma_products';
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Define fillable fields
    protected $fillable = [
        'code', 'name', 'second_name', 'slug', 'product_details',
        'price', 'mrp', 'promo_price', 'category_id',
        'subcategory_id', 'brand', 'unit', 'quantity',
        'image', 'product_status', 'date_created', 'status_date', 'hide'
    ];

    // Define casting for specific fields
    protected $casts = [
        'price' => 'float',
        'mrp' => 'float',
        'promo_price' => 'float',
        'quantity' => 'integer',
        'product_status' => 'integer',
        'hide' => 'boolean'
    ];

    /**
     * Get the promotion price for the product.
     * Maps the 'promo_price' database column to 'promotion_price' property
     */
    public function getPromotionPriceAttribute()
    {
        return $this->promo_price;
    }

    /**
     * Set the promotion price for the product.
     * Maps the 'promotion_price' property to 'promo_price' database column
     */
    public function setPromotionPriceAttribute($value)
    {
        $this->attributes['promo_price'] = $value;
    }

    /**
     * Get the product details - maps product_details field to details property
     */
    public function getDetailsAttribute()
    {
        return $this->product_details;
    }

    /**
     * Set the product details
     */
    public function setDetailsAttribute($value)
    {
        $this->attributes['product_details'] = $value;
    }

    // Define relationships
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /**
     * Get the subcategory that owns the product
     */
    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit');
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class, 'product_id');
    }

    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id')->with('attribute');
    }

    public function serials()
    {
        return $this->hasMany(ProductSerial::class, 'product_id');
    }

    public function status()
    {
        return $this->belongsTo(ProductStatus::class, 'product_status', 'id');
    }

    // This relationship is being kept but won't be used in API responses
    protected function warehouses()
    {
        return $this->hasMany(WarehouseProduct::class, 'product_id');
    }
} 