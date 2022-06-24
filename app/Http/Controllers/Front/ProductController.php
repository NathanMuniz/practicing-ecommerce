<?php

namespace App\Http\Controllers\Front;

use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;

class ProductController extends Controller
{
    use ProductTransformable;

    private $productRepo; 

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository; 
    }

    public function search()
    {
        $list = $this->productRepo->searchProduct(request()->input('q'));

        $products = $list->where('status', 1)->map(function (Product $item) {
            return $this->transformProduct($item);
        });

        return view('front.products.product-search', [
            'products' => $this->productRepo->paginateArrayResults($products->all(), 10)
        ]);
    }

    public function show(string $slug)
    {
        $product = $this->productRepo->findProductBySlug(['slug' => $slug]);
        $images = $product->imagens()->get();
        $category = $product->categories()->first();
        $productAttributes = $product->attributes;

        return view('front.products.products', compact(
            'product',
            'imagens',
            'productAttributes',
            'category'
        ));

    }

}


?>