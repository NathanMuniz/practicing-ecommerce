<?php

namespace App\Shop\Products\Repositories\Interfaces;

use App\Shop\AttributeValues\AttributeValue;
use Jsdecena\Baserepo\BaseRepositoryInterface;
use App\Shop\Brands\Brand;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Product;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;


interface ProductRepositoryInterface extends BaseRepositoryInterface 
{

    public function listProduct(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;

    public function createProduct(array $data) : Product; 

    public function updateProduct(array $data) : bool;

    public function findProduct(array $id) : Product;

    public function deleteProduct(Product $product) : bool; 

    public function removeProduct() : bool; 

    public function detachCategories();

    public function syncCategories(array $params);

    public function deleteFile(array $file, $disk = null) : bool;

}



?>