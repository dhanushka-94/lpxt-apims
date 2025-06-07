<?php

require 'vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// List all tables in the database
$tables = DB::select('SHOW TABLES');
echo "Tables in the database:\n";
foreach ($tables as $table) {
    $tableName = array_values(get_object_vars($table))[0];
    echo "- $tableName\n";
}

// Check if sma_products table exists
$productTable = 'sma_products';
$tableExists = DB::select("SHOW TABLES LIKE '{$productTable}'");
if (empty($tableExists)) {
    echo "\nThe '{$productTable}' table does not exist in the database.\n";
    exit;
}

// Get sample product data
echo "\nSample product data:\n";
$products = DB::table($productTable)->limit(5)->get();
print_r($products);

// Check the structure of sma_product_status table
echo "Product Status Table Structure:\n";
try {
    $columns = DB::select("SHOW COLUMNS FROM sma_product_status");
    foreach ($columns as $column) {
        echo "- " . $column->Field . " (" . $column->Type . ")\n";
    }

    // Get data from product_status table
    echo "\nProduct Status Values:\n";
    $statuses = DB::table('sma_product_status')->get();
    print_r($statuses);
} catch (\Exception $e) {
    echo "Error checking product status table: " . $e->getMessage() . "\n";
}

// Look at some products with different status values
echo "\nProducts with different status values:\n";

// This query returns one example product for each status value
$uniqueStatusValues = DB::table('sma_products')
    ->select('product_status')
    ->distinct()
    ->get()
    ->pluck('product_status');

echo "Unique product status values found: " . implode(', ', $uniqueStatusValues->toArray()) . "\n\n";

// Get one example product for each status
foreach ($uniqueStatusValues as $status) {
    $product = DB::table('sma_products')
        ->select(['id', 'code', 'name', 'product_status', 'status_date'])
        ->where('product_status', $status)
        ->first();
    
    if ($product) {
        echo "Status {$status}: Product #{$product->id} ({$product->code}) - {$product->name}\n";
        echo "  Status Date: {$product->status_date}\n\n";
    }
} 