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
        /**Buscar o correio eviado pelo request */
        $courier = $this->courierRepo->findCourierById(request()->session()->get('courierId', 1));

        /**Busca a taxa de envio referente ao correio */
        $shippingFee = $this->cartRepo->getShippingFee($courier);

        /**Retona a view do cart, passando como contexto: cartItems, subtotal, text,
         * shippingFee, e total. Buscamos essa valores do cartRepo.
         */
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
        /**Busca o produto enviado pelo request */
        $product = $this->prouctRepo->findProductById($request->input('product'));

        /**Se esse produto tiver pelo menos 1 atributo */

        if ($product->attributes()->count() > 0) {

            /**Ele faz busca desse primeiro atributos. e joga dentro de productAttr */
            $productAttr = $product->attributes()->where('default', 1)->first();
            
            /**Verifica o atributo buscado tem um sale_price definido */
            if (isset($productAttr->sale_price)) {
                /**Se tive iremos fazer com que o preço do nosso produto
                 * Seja o mesmo preço do attributo.
                 */
                $product->price = $productAttr->price;

                /**Verificamos novamente se o sale price do atributo 
                 * é null. Se não for null
                 */
                if(!is_null($productAttr->sale_price)) {
                    /**Iremos definir o preço do producuto como o 
                     * sale_price do atrributo e não como o price.
                     */
                    $product->price = $productAttr->sale_price;
                }
            }

        }

        /**declaramso um objeto opetions que será usado para enviar pelo contexto */
        $options = [];

        /**Verificamos se o request tem productAttribute enviado nele */
        if ($request->has('productAttribute')) {
            /**se Tive então buscar esse atributos no nosso banco de dados
             * e jogamos dentro da variável attr.
             */
            $attr = $this->productAttributeRepo->findProductAttributeById($request->input('productAttribute'));

            /**então definimos o preço do produto, como o sale_price do attr, ou o 
             * price do attr. usamos o operador ?? para usar o que não for null.
             */
            $product->price = $attr->sale_price ?? $attr->price;
            
            /**Então definimos na key product_attribute_id, o valor do productAttribute
             * envido pelo request. isso dentro do dicionário options
             */
            $options['product_attribute_id'] = $request->input('productAttribute');
            
            /**Damos outra key para o opotion combination, e essa terá o valor
             * do attr->attributesValue, em modo array.
             */
            $options['combination'] = $attr->attributesValues->toArray();
        }

        /**usamos o repo do cart para adicionat tudo isso ao nosoo cart
         * product, request 'quality', options
         */
        $this->cartRepo->addToCart($product, $request->input('quantity'), $options);

        /**Pro fim fazemos um redirect para o cart index, e enviams uma mensage
         * de sucesso.
         */
        return redirect()->route('cart.index')
            ->with('message', 'Add to cart sucessful');

    }


}





?>