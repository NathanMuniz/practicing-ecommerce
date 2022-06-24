<?php

namespace App\Shop\Products\Repositories;

use App\Shop\AttributeValues\AttributeValue;
use App\Shop\Products\Exceptions\ProductCreateErrorException;
use App\Shop\Products\Exceptions\ProductUpdateErrorException;
use App\Shop\Tools\UploadableTrait;
use Jsdecena\Baserepo\BaseRepository;
use App\Shop\Brands\Brand;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\ProductImages\ProductImage;
use App\Shop\Products\Exceptions\ProductNotFoundException;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Transformations\ProductTransformable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    use ProductTransformable, UploadableTrait;

    /**
     * ProductRepository contructor.
     */

    public function __construct(Product $product)
    {
        parent::__construct($product);
        $this->model = $product;
    }

    public function listProducts(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection
    {
        return $this->all($columns, $order, $sort);
    }

    public function createProduct(array $data) : Product 
    {
        try {
            return $this->create($data);
        } catch (QueryException $e) {
            throw new ProductCreateErrorExeption($e);
        }
    }

    public function updateProdut(array $data) : bool 
    {
        $filtered = collect($data)->except('image')->all();

        try {
            return $this->model->where('id', $this->model->id)->update($filtered);
        } catch (QueryException $e) {
            throw new ProductUpdateErrorExeption($e);
        }
    }

    public function findProductById(int $id) : Product 
    {
        try {
            return $this->transformProduct($this->findOneOrFail($id));
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException($e);
        }
    }

    public function deleteProduct(Product $product) : bool 
    {
        $product->images()->delete();
        return $product->delete();
    }

    public function removeProduct() : bool 
    {
        return $this->model->where('id', $this->model->id)->delete();
    }

    public function detachCategories()
    {
        $this->model->categories()->detach();
    }

    public function getCategories() : Collection 
    {
        return $this->model->categories()->get();
    }

    public function deleteFile(array $file, $disk = null): bool 
    { 
        return $this->update(['cover' => null], $file['product']);
    }

    public function deleteCover() : bool 
    {
        return $this->model->update(['cover' => null]);
    }



}




?>