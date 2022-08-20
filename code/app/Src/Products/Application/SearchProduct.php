<?php

namespace App\Src\Products\Application;

use App\Models\Product;

class SearchProduct
{
    const SIZE_PAGE = 10;

    private function query()
    {
        $queryProduct = Product::query();
        return $queryProduct;
    }

    public function get()
    {
        return $this->query()->get();
    }

    public function paginate($pageLength = self::SIZE_PAGE, $page)
    {
        return $this->query()->paginate($pageLength, page:$page);
    }

}
