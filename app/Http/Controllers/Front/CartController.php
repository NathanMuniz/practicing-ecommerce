<?php

namespace App\Http\Controllers\Front;

use App\Shop\Carts\Requests\AddToCartRequest;
use App\Shop\Carts\Requests\UpdateCartRequest;
use App\Shop\Carts\Repositories\Interfaces\CartRepositoryInterface;
use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Transformations\ProductTransformable;
use App\Http\Controllers\Controller;

class CartController extends Controller 
{

    use ProductTransformable;

    private $cartRepo;
    
    private $productRepo;

    private $courierRepo;

    private $ProductAttributesRepo;

    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        CourierRepositoryInterface $courierRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository
    ) {
        $this->cartRepo = $cartRepository;
        $this->productRepo = $productRepository;
        $this->courierRepo = $courierRepository;
        $this->productAttributeRepo = $productAttributeRepository;
    }

    public function index()
    {
        $courier = $this->courierRepo->findCourierById(request()->session()->get('courierId', 1));
        $shippingFee = $this->cartRepo->getShippingFee($courier);

        return view('front.carts.cart', [
            'cartItems' => $this->cartRepo->getCartItemsTensformed(),
            'subtotal' => $this->cartRepo->getSubTotal(),
            'text' => $this->cartRepo->getTax(),
            'shippingFee' => $shippingFee, 
            'total' => $this->cartRepo->getTotal(2, $shippingFee)
        ]);
    }

    public function store(AddToCartRequest $request)
    {
        $product = $this->prouctRepo->findProductById($request->input('product'));

        if ($product->attributes()->count() > 0) {
            $productAttr = $product->attributes()->where('default', 1)->first();
            
        }
    }


}





?>