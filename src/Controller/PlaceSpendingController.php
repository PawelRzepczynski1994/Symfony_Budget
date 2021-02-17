<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlaceSpendingController extends AbstractController
{
    /**
    * @Route("/place_spending", name="place_spending")
    */
    public function index(){
        
        return $this->render('main/placespending/placespending.html.twig');

    }

}
?>