<?php
namespace App\Controller;

use App\Entity\FixedExpenses;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class FixedExpensesController extends AbstractController
{
    /**
    * @Route("/fixed_expenses", name="fixed_expenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
    $fixed_expenses = $this->getDoctrine()->getRepository(FixedExpenses::class)->ViewFixedExpenses($this->getUser()->getId());

    return $this->render('main/fixedexpenses/fixedexpenses.html.twig',[
        'fixed_expenses' => $fixed_expenses,
    ]);
    }

}
?>