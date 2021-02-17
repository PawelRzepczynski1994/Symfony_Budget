<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FixedExpensesController extends AbstractController
{
    /**
    * @Route("/fixed_expenses", name="fixed_expenses")
    */
    public function index(){
        return $this->render('main/fixedexpenses/fixedexpenses.html.twig');
    }

}
?>