<?php
namespace App\Src\Products\Application;

class DestroyProduct
{
    public function __invoke(
        Product $product
    ): bool {

        $product->delete();

        return true;

    }
}
