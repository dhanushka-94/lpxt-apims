<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSerial extends Model
{
    use HasFactory;

    protected $table = 'sma_product_serials';
    protected $primaryKey = 'id';
    protected $fillable = ['purchase_id', 'purchase_item_id', 'product_id', 'serial_number', 'serial_status', 'status'];
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
} 