<?php 

namespace App\Shop\Address\Transaction;


use App\Shop\Addresses\Address;
use App\Shop\Cities\Repositories\CityRepository;
use App\Shop\Countries\Repositories\CountryRepository;
use App\Shop\Customers\Customer;
use App\Shop\Customers\Repositories\CustomerRepository;
use App\Shop\Provinces\Province;
use App\Shop\Provinces\Repositories\ProvinceRepository;
use App\Shop\Cities\City;
use App\Shop\Countries\Country;

trait AddressTransformable
{
    public function transformAddress(Address $address)
    {

        /**
         * Instancia o Objeto Address
         * e adiciona algumas propriedades, do objeto que foi passado
         * na função, são eleas: id, alieas, adrees_1, addres_2, zip, city
         */
        
         # Para instanciar não prcisa adicioanr (). Basta adicionar o new. 
         # Você só usa o (), quando precisar passar algum parâmetro. 
  
        $obj = new Address;
        $obj->id = $address->id;
        $obj->alieas = $address->alies;
        $obj->address_1 = $address->address_1;
        $obj->address_2 = $address->address_2;
        $obj->zip = $address->zip;
        $obj->city = $address->city;
        


        /**
         * Verifica se o address que foi passado tem a variável 
         * province_id delcarada.
         * Se tiver:
         * Instancia um novo objeto do provinceRepository, tem que passar um Objeto Province
         * Usa a função, findProvinceById, para buscar a province que foi passada, 
         * joga em uam variável 
         * 
         * Depois define, no objeto criado, a propety province, passando para ela a propety name, do Objeto encontrado 
         */

         if(isset($address->province_id)){
            $provinceRepo = new provinceRepository(new Province);
            $province = $provinceRepo->findProvinceById($address->province_id);
            $obj->province = $province->name;
         }

       
        /**Instacia o reontry repository, passando um contry objeto como parêmetro
         * Então usa esse repo para fazer uma busca por id no contry, e retornar o contry que foi
         * passado pelo address.
         * Após isso joga no nosso objeto, dentro da propetpy country, apenas o nome do country */        
         
        $coutryRepo = new coutraRepository(new Country);
        $country = $coutryRepo->findCoutryById($address->coutry);
        $obj->country = $country->name;


        /**
         * Instancia um customer, do CustomerRepository, tem que passar um Customer
         * Busca então um customer, referente ao cutomer_id que foi passado no nosso addres
         * define a propety, customer, de nosso obj, para o customer name
         * E define também status, como o address status que foi passado.
         * No fim retorna o obj, que agora é um endreço transformado.
         */

         $customerRepo = new customerRepository(new Coutomer);
         $customer = $customerRepo->findCustomerById($address->customer_id);
         $obj->customer = $customer->name;
         $obj->status = $address->status; 
         
         return $obj; 


    }
}


?>