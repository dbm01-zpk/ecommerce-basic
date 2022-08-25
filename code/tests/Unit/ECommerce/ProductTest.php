<?php
namespace Tests\Unit\ECommerce;

use App\Models\Product;
use App\Src\Products\Application\DestroyProduct;
use App\Src\Products\Application\StoreProduct;
use App\Src\Products\Application\UpdateProduct;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class CatalogTest extends TestCase {

    /**
     *
     * Test
     * --------------------
     * [x] Create product -> test_create_product_with_usecase
     * [x] Edit name product renew slug -> test_edit_product_name_renew_slug
     * [x] Edit product -> test_edit_product
     * [x] Delete product -> test_delete_product_with_usecase
     *
     */

    use WithFaker;
    use DatabaseTransactions;

    public function test_create_product_with_usecase() {
        $product = (new StoreProduct())(
            $this->faker->name(),
            $this->faker->paragraph(),
            $this->faker->randomFloat(2, 0, 10000),
            $this->faker->boolean()
        );

        $this->assertInstanceOf(Product::class, $product);

    }

    public function test_edit_product() {

        $product = Product::factory()->create();

        $description = $this->faker->paragraph;
        $price       = $this->faker->randomFloat(2, 0, 10000);
        $status      = $this->faker->boolean;

        $data_update = [
            'description' => $description,
            'price'       => $price,
            'status'      => $status,
        ];

        $product = (new UpdateProduct())(
            $product,
            $data_update
        );

        $new_data_product = [
            'description' => $product->description,
            'price'       => $product->price,
            'status'      => $product->status,
        ];

        $this->assertEquals($data_update, $new_data_product);

    }

    public function test_edit_product_name_renew_slug() {

        $product = Product::factory()->create();

        $new_name = $this->faker->name();

        $product = (new UpdateProduct())(
            $product,
            [
                'name' => $new_name,
            ]
        );

        $this->assertEquals(Str::slug($new_name), $product->slug);

    }

    public function test_delete_product_with_usecase() {

        $product = Product::factory()->create();
        (new DestroyProduct())($product);
        $this->assertModelMissing($product);

    }

}