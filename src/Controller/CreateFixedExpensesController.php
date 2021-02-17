<?php
namespace App\Controller;

use App\Form\Type\CreateFixedExpensesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class CreateFixedExpensesController extends AbstractController
{
    /**
    * @Route("/createfixed_expenses", name="createfixed_expenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $form = $this->createForm(CreateFixedExpensesType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

        }



        return $this->render('main/fixedexpenses/createfixedexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
?>