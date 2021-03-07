<?php
namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateCategory
{
    private CategoryRepository $categoryRepository;
    private SessionInterface $session;

    public function __construct(CategoryRepository $categoryRepository,SessionInterface $session)
    {
        $this->categoryRepository = $categoryRepository;
        $this->session = $session;
    }
    public function create($user,$data)
    {
        $category = $this->categoryRepository->countNameCategory($data["namecategory"]);
        if($category != 0)
        {
           $this->session->set('error', 'Posiadasz już taką kategorię!');
           return true;
        }
        $category = new Category($user->getId(),$data["namecategory"]);
        $this->categoryRepository->save($category);
        $this->session->set('error', 'Utworzyłeś nową kategorię:'.$data['namecategory']);
        return true;
    }
}
?>