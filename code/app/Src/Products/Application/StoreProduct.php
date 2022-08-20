<?php
namespace App\Src\Products\Application;

use App\Models\Product;

class StoreProduct
{
    public function __invoke(
        string $name,
        string $description,
        float $price,
        bool $status = false,
    ): Product {

        $product = Product::create([
            'name'        => $name,
            'description' => $description,
            'price'       => $price,
            'status'      => $status,
        ]);

        return $product;
    }
}
