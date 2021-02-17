<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ExpensesController extends AbstractController
{
    /**
    * @Route("/expenses", name="expenses")
    */
    public function index(){
        return $this->render('main/expenses/expenses.html.twig');
    }

}
?>