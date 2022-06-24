<?php 

namespace App\Http\Controllers\Front; 

use App\Shop\Categories\Repositories\Interfaces\CategoryRepositoryInterface; 

class HomeController 
{
    /**
     * @var CategoryRepositoryIterfac
     */

     private $categoryRepo; 

     public function __construct(CategoryRepositoryInterface $categoryRepository)
     {
         $this->categoryRepo = $categoryRepository;
     }

     public function index()
     {
        $cat1 = $this->categoryRepo->findCategoryById(2);
        $cat2 = $this->categoryRepo->findCategoryById(3);

        return view('front.index', compact('cat1', 'cat2'));
     }


}





?>