<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditPlacesExpensesController extends AbstractController
{
    /**
    * @Route("/editplace_expenses", name="editplace_expenses")
    */
    public function index(){
        return $this->render('main/placespending/editplaceexpenses.html.twig');
    }

}
?>