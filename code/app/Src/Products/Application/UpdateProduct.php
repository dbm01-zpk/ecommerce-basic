<?php
namespace App\Src\Products\Application;

use App\Models\Product;

class UpdateProduct
{
    public function __invoke(
        Product $product,
        array $data
    ): Product {

        $product->update($data);

        return $product;

    }
}
