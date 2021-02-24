<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

class CreateCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    public function create($user,$data)
    {
        $category = $this->categoryRepository->countNameCategory($data["namecategory"]);
        if($category != 0)
        {
           return false;
        }
        $category = new Category();
        $category->setName($data["namecategory"]);
        $category->setIdUser($user->getId());
        $this->categoryRepository->save($category);
        return true;
    }
}
?>