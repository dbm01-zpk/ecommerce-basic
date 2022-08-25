<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use App\Src\Products\Application\DestroyProduct;
use App\Src\Products\Application\SearchProduct;
use App\Src\Products\Application\StoreProduct;
use App\Src\Products\Application\UpdateProduct;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductController extends Controller {

    public function index(
        Request $request,
        SearchProduct $search
    ): JsonResource {
        $page     = $request->page ?? 1;
        $products = $search->paginate(page:$page);
        return ProductResource::collection($products);
    }

    public function store(
        StoreProductRequest $request,
        StoreProduct $store
    ): ProductResource {
        $product = $store(
            $request->name,
            $request->description,
            $request->price,
            $request->status
        );

        return new ProductResource($product);
    }

    public function show(Product $product): ProductResource {
        return new ProductResource($product);
    }

    public function update(
        StoreProductRequest $request,
        Product $product,
        UpdateProduct $update
    ): ProductResource {
        $product = $update(
            $product,
            $request->validated()
        );

        return new ProductResource($product);
    }

    public function destroy(
        Product $product,
        DestroyProduct $destroy
    ) {

        $destroy($product);

        return response(null, 204);
    }
}
