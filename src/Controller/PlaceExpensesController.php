<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlaceExpensesController extends AbstractController
{
    /**
    * @Route("/place_expenses", name="place_expenses")
    */
    public function index(){
        return $this->render('main/placespending/placeexpenses.html.twig');
    }

}
?>