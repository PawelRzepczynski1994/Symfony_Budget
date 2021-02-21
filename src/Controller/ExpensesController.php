<?php
namespace App\Controller;

use App\Entity\Expenses;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class ExpensesController extends AbstractController
{
    /**
    * @Route("/expenses", name="expenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
    $expenses = $this->getDoctrine()->getRepository(Expenses::class)->ViewExpenses($this->getUser()->getId());

    return $this->render('main/expenses/expenses.html.twig',[
        'expenses' => $expenses,
    ]);
    }

}
?>