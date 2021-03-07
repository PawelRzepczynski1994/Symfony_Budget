<?php
namespace App\Controller;

use App\Service\CreateCategory;
use App\Service\EditCategory;
use App\Service\DeleteCategory;
use App\Service\ViewCategory;

use App\Form\Type\CreateCategoryType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class CategoryController extends AbstractController
{
    private CreateCategory $createCategory;
    private EditCategory $editCategory;
    private DeleteCategory $deleteCategory;
    private ViewCategory $viewCategory;
    private SessionInterface $session;

    public function __construct(
        CreateCategory $createCategory,
        EditCategory $editCategory,
        DeleteCategory $deleteCategory,
        ViewCategory $viewCategory,
        SessionInterface $session
    )
    {
        $this->createCategory = $createCategory;
        $this->editCategory = $editCategory;
        $this->deleteCategory = $deleteCategory;
        $this->viewCategory = $viewCategory;
        $this->session = $session;
    }

    /**
    * @Route("/list_category", name="category")
    */
    public function viewCategory()
    {
        $category = $this->viewCategory->viewCategory($this->getUser());
        return $this->render('main/category.html.twig',[
            'category' => $category
        ]);
    }

    public function addCategory(Request $request)
    {
        $form = $this->createForm(CreateCategoryType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->createCategory->create($this->getUser(),$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }       
        return $this->render('main/createcategory/create_category.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function editCategory()
    {

    }

    public function deleteCategory()
    {

    }

    /**
     * @Route("/info_create_category", name="info_category")
     */
    public function InfoCategory(SessionInterface $session)
    {
        $error = $this->session->get('error');
        return $this->render('main/createcategory/error.html.twig',[
            'error_log' => $error,
        ]);
    }
}
?>