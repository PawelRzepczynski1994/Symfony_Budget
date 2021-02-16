<?php
namespace App\Controller;

use App\Entity\Category;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class CategoryController extends AbstractController
{
    /**
    * @Route("/list_category", name="category")
    */
    public function CategoryView(EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $category = $this->ViewAllCategory($user,$entityManager);
        return $this->render('main/category.html.twig',[
            'category' => $category
            ]);
    }
    public function ViewAllCategory($user,EntityManagerInterface $entityManager)
    {
        $repository = $entityManager->getRepository(Category::class);
        $category = $repository->findbyUserId($user->getId());
        return $category;
    }
}
?>