<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IncomeSourceController extends AbstractController
{
    /**
    * @Route("/income_source", name="income_source")
    */
    public function index(){


        return $this->render('main/incomesource/incomesource.html.twig');
    }

}
?>