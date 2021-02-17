<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditCategoryController extends AbstractController
{
    /**
    * @Route("/edit_category", name="edit_category")
    */
    public function index(){
        
        return $this->render('main/createcategory/editcreatecategory.html.twig');
    }

}
?>