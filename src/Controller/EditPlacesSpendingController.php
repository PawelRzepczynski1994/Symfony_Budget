<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EditPlacesSpendingController extends AbstractController
{
    /**
    * @Route("/editplace_spending", name="editplace_spending")
    */
    public function index(){

        return $this->render('main/placespending/editplacespending.html.twig');
    }

}
?>