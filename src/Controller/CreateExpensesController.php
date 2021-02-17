<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreateExpensesController extends AbstractController
{
    /**
    * @Route("/create_expenses", name="create_expenses")
    */
    public function index(){
        return $this->render('main/expenses/createexpenses.html.twig');
    }

}
?>