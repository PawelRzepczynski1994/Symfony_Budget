<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CreatePlacesSpendingController extends AbstractController
{
    /**
    * @Route("/create_placesspending", name="create_placesspending")
    */
    public function index(){
        return $this->render('main/placespending/createplacespending.html.twig');

    }

}
?>