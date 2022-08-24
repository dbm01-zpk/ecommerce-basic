<?php
namespace App\Src\Products\Application;

use App\Models\Product;

class DestroyProduct {
    public function __invoke(
        Product $product
    ): bool {

        $product->delete();

        return true;

    }
}
