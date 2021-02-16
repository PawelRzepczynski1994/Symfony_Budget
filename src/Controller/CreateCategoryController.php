<?php
namespace App\Controller;

use App\Entity\Category;
use App\Form\Type\CreateCategoryType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;


class CreateCategoryController extends AbstractController
{
    /**
    * @Route("/create_category", name="create_category")
    */
    public function CreateCategory(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $repository = $entityManager->getRepository(Category::class);

        $form = $this->createForm(CreateCategoryType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $new_category = $form->getData();
            $category = $repository->countNameCategory($new_category["namecategory"]);
            if($category != 0){
                $session->set('error', 'Posiadasz już taką kategorię!');
                return $this->redirectToRoute('info_category');
            }
            $category = new Category();
            $category->setName($new_category["namecategory"]);
            $category->setIdUser($this->getUser()->getId());
            $entityManager->persist($category);
            $entityManager->flush();
            $session->set('error', 'Utworzyłeś nową kategorię:'.$new_category["namecategory"]);
            return $this->redirectToRoute('info_category');
        }
        return $this->render('main/createcategory/create_category.html.twig',[
            'form' => $form->createView(),
        ]);
    }

   /**
     * @Route("/info_create_category", name="info_category")
     */
    public function CreateCategoryInfo(SessionInterface $session){
       
        $error = $session->get('error');
        $session->set('error',NULL);
        return $this->render('main/createcategory/error.html.twig',[
            'error_log' => $error,
        ]);
    }


}

?>