<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $table = 'sma_warehouses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(WarehouseProduct::class, 'warehouse_id');
    }
} 