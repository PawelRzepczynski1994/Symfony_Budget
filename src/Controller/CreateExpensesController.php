<?php
namespace App\Controller;

use App\Entity\Expenses;
use App\Form\Type\CreateExpensesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class CreateExpensesController extends AbstractController
{
    /**
    * @Route("/create_expenses", name="create_expenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $repository = $entityManager->getRepository(Expenses::class);

        $form = $this->createForm(CreateExpensesType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $new_expenses = $form->getData();
            $expense = new Expenses();
            $expense->setIdUser($this->getUser()->getId());
            $expense->setIdCategory($new_expenses["category"]->getId());
            $expense->setIdPlaceExpenses($new_expenses["place_expenses"]->getId());
            $expense->setIdWallet($new_expenses["wallet"]->getId());
            $expense->setDate($new_expenses["date_start"]->getTimestamp());
            $expense->setDescription($new_expenses["description"]);
            $expense->setAmount($new_expenses["amount"]);
            $entityManager->persist($expense);
            $entityManager->flush();
            $session->set('error', 'Utworzyłeś nowy wydatek!');
            return $this->redirectToRoute('info_category');
        }

        return $this->render('main/expenses/createexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
?>