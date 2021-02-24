<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class ViewCategory
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }
    
    public function viewCategory($user){
        $category = $this->categoryRepository->findbyUserId($user->getId());
        return $category;
    }
}
?>