<?php

namespace App\Http\Controllers\Admin\Addresses;

use App\Shop\Addresses\Address;
use App\Shop\Addresses\Repositories\AddressRepository;
use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;
use App\Shop\Addresses\Requests\CreateAddressRequest;
use App\Shop\Addresses\Requests\UpdateAddressRequest;
use App\Shop\Addresses\Transformations\AddressTransformable;
use App\Shop\Cities\City;
use App\Shop\Cities\Repositories\Interfaces\CityRepositoryInterface;
use App\Shop\Countries\Country;
use App\Shop\Countries\Repositories\CountryRepository;
use App\Shop\Countries\Repositories\Interfaces\CountryRepositoryInterface;
use App\Shop\Customers\Repositories\Interfaces\CustomerRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Provinces\Repositories\Interfaces\ProvinceRepositoryInterface;
use Illuminate\Http\Request;

class AddressController extends Controller 
{
    /**Iremo usar a classe Addres, então já "instalamos" ela aqui */
    use App\Shop\Addresses\Address;

    /**Defiimos algumas variáveis que serão privadas. Elas que são privadas, porque
     * consegue alterar coisas no banco de dados. São os repositórios.
     * São eles: Repository - Addres, custom, country e city.
     */

     private $addressRepo = new AddressRepository;
     private $customsRepo = new CustomRepository;
     private $countryRepo = new CountryRepository;
     private $cityRepo = new CityRepository;


    /**Então criamos um crustuor, que pede como parâmetro esses repositóriods */
    /**E jogamso cada um desse repositório, para nossa classe cirada.
     * O único que não precisa ser privado é o province.
     */

     public function __construct(
        AddressRepository $addressRepo,
        CustomRepository $customRepo,
        CountryRepository $countryRepo,
        CityRepository $cityRepo,
        ProvinceRepository $provinceRepo,
     ){
        $this->addressRepo = $addressRepo;
        $this->customRepo = $customRepo;
        $this->countryRepo = $countryRepo;
        $this->cityRepo = $cityRepo;
        $this->provinceRepo = $provinceRepo;
     }
   

    /**View referente a rota index
     * cria uma lista que contem todos os address. Ela usa a função listAddress, do
     * address repo que faz parte de nossa classe. ele irá buscar pela, data de criação
     * em ordem descrecente. 
     * 
     * Veririca se o request tem a letra 'q'. Se tiver - {não usaremos o listAddress, ou sejá, 
     * não retornará todos addres. Usaremos a função serachAddress, que necessitará de um 
     * vai buscar um único address, no repo, e vai usar os dados envidos através do q
     * Ou sejá vai recuperar os dados do q, envido no resquets.
     * 
     * Então iremos mapear o array com lista de enderçoes. A função de callback será objeto addres
     * Então iremos para cada address, tranformar ele, usando o método transofrmAddress. 
     * Certificaremos que vamos fazer isso com todos, e vamso jogar dentro da variável addreeses
     * 
     */
    public function index(Request $request)
    {
        $addressRepo = new AddressRepository;
        $listAddress = $addressRepo->findAll('created_at', 'desc');

        if($request->has('q')){
            $listAddress = $addressRepo->serachOne($request->input('q'));
            $listAddress->map(new Address)
        }
    }
    

        /**retorna, a view do admin, addreses, list,
         * Tem retonarmso o contexto em uma lista. Basicmaente tornoamso o addresses.
         * Mas jogadores ele dentro da função, paginateArrayResults, que é do addresRepo.
         * Que importamos na em cima. e Enviaremos isso como nome "addreses", dentro de um dicionários.
         */

    
    
    
    }


}