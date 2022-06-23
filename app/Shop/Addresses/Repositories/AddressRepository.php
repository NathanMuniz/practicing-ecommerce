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

     /**Construtuor da classe. 
      * Ele recebe um address como parâmetro.
      * chama o contrutor da classe pai, e passe a ele o address
      * Cria variável model e define ela como address.
      */

    public function __construct(Address $address)
    {
      parent::__construct($address);
      $this->model = $address; 
    }
    

    /**
    * Função createAddress. Recebe array data como parâmetro.
    * ": Address "? 
    * 
    * Ela tem um try e um catach. No try ela tentar criar um address
    * usando método create, que recebe a data como parâmetro e retornar.
    * Se não funciona ele pega a Exessão como e, mas não envia ela.
    * Dntro do catch ele envia uma instância do objeto CreateAddressErrorExpection
    * Passando dentro a mensagem.
    */

    public function createAddress(array $data)
    {
      try {
        return $this->create($data);
      } catch (QueryException $e) {
        throw new CreateAddressErrorExpection('Fail to create the address.');
      }
    }
  
   
     /**
      * Attach the customer to the addres
      *
      *
      *@param Address $address
      *@param Customer $customer 
      */
      
    /**
     * Função attachToCustomer. 
     * Receber um objeto address, e um objeto customer como parâmetro
     * 
     * Ela usar o função do customer addresses()->save() e passa 
     * o nosso objeto address. 
     */

    public function attachToCutomer(Address $address, Customer $customer)
    {
      $customer->addresses()->save($address);
    }

  

    /**
   * @param array $data
   * @return bool
   */

    /**
     * função updateAddress.
     * Recebe uma data como parâmetro, que é um array.
     * ": bool"?
     * retorna a função update, herdade da classe parent, usando data
     * como parâmetro 
     */
    public function updateAddress(array $data) : bool
    {
      return $this->update($data);
    }
  
     

    /**Soft delete the address 
     * função deleteAddress
     * Primeiro ele dessadocia o customer com o address
     *    Para isso ele usa o objeto model da nossa classe, 
     *    usa a função customer()->dissasociate()
     * Depois ele retorna o exclusão do Address
     *    usa o objeto model, usando a função delete()
     * 
    */

    public function deleteAddress()
    {
      $this->model->customer()->dissasociate();
      return $this->model->delete();
    }

      

      /**
       * List all the address
       * 
       * @param string $order
       * @param string $sort 
       * @param array $columns
       * @return array|Collection
       */
      
      /**
       * função listAddress
       * Usar como parãmetro, order = 'id'. sort = 'desc', comuns = ['*']
       * retorna a função all, do nosso objeto, pasando os parâmetros, comuns, ordem e sort
       * 
       */

      public function listAddress(string $order="id", string $sort='desc', array $comuns = ['*'])
      {
        $this->all($comuns, $ordem, $sort);
      }

   

       /**
        * Return the address
        */
       
        






}



?>