<?php
namespace App\Controller;

use App\Form\Type\CreateSourceIncomeType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class IncomeSourceController extends AbstractController
{
    /**
    * @Route("/income_source", name="income_source")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {

        return $this->render('main/incomesource/incomesource.html.twig');
    }

}
?>