<?php

namespace App\Shop\Addresses\Repositories;

use App\Shop\Addresses\Address;
use App\Shop\Addresses\Exceptions\CreateAddressErrorException;
use App\Shop\Addresses\Exceptions\AddressNotFoundException;
use App\Shop\Addresses\Repositories\Interfaces\AddressRepositoryInterface;
use App\Shop\Addresses\Transformations\AddressTransformable;
use App\Shop\Cities\City;
use App\Shop\Countries\Country;
use App\Shop\Customers\Customer;
use App\Shop\Provinces\Province;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Jsdecena\Baserepo\BaseRepository;

/**Classe, que referente ao repositório de endereços, então ela herda do extends */

class AddressRepository extends BaseRepository implements AddressRepositoryInterface 
{
    use AddressTransformble; 

    /**
     * AddressRepository construcotr.
     * @param Address $address
     */






}



?>