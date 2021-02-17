<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditFixedExpensesController extends AbstractController
{
    /**
    * @Route("/createfixed_expenses", name="createfixed_expenses")
    */
    public function index(){
        return $this->render('main/fixedexpenses/createfixedexpenses.html.twig');

    }

}
?>