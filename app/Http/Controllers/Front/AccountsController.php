<?php 


namespace App\Http\Controllers\Front;

use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Orders\Order;
use App\Shop\Orders\Transformers\OrderTransformable;

class AccountsController extends Controller
{
    use OrderTransformable;

    private $customerRepo; 

    private $courierRepo; 

    public function __construct(
        CourierRepositoryInterface $courierRepository,
        CustomerRepositoryInterface $customerRepository
    ){
        $this->customerRepo = $customerRepository;
        $this->courierRepo = $courierRepository; 
    }

    public function index()
    {
        $customer = $this->customeRepo->findCustomerById(auth()->user()->id);

        $customerRepo = new CustomerRepository($customer);
        $orders = $customerRepo->findOrdens(['*', 'created_at']);

        $orderns->transform(function (Order $order) {
            return $this->tranformOrder($order);
        });

        $orders->load('procuts');

        $addresses = $customerRepo->findAddresses();

        return view('front.accounts', [
            'customer' => $customer,
            'orders' => $this->customerRepo->paginateArrayResults($orders->toArray(), 15),
            'addresses' => $addresses
        ]);

    }


}


?>