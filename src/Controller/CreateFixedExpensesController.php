<?php
namespace App\Controller;

use App\Entity\FixedExpenses;
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
        $repository = $entityManager->getRepository(FixedExpenses::class);

        $form = $this->createForm(CreateFixedExpensesType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $new_expenses = $form->getData();
            $expense = $repository->countNameFixedExspenses($new_expenses["name"]);
            if($expense != 0){
                $session->set('error', 'Posiadasz już taki wydatek stały!');
                return $this->redirectToRoute('info_category');
            }

            $expense = new FixedExpenses();
            $expense->setName($new_expenses["name"]);
            $expense->setIdUser($this->getUser()->getId());
            $expense->setIdCategory($new_expenses["category"]->getId());
            $expense->setIdPlaceExpenses($new_expenses["place_expenses"]->getId());
            $expense->setIdWallet($new_expenses["wallet"]->getId());
            $expense->setFirstDate($new_expenses["first_date"]->getTimestamp());
            $expense->setFrequencyPayments($new_expenses["frequency_payments"]);
            $expense->setDescription($new_expenses["description"]);
            $expense->setAmount($new_expenses["amount"]);
            $expense->setActive($new_expenses["active"]);
            $entityManager->persist($expense);
            $entityManager->flush();
            $session->set('error', 'Utworzyłeś nowy wydatek stały:'.$new_expenses["name"]);
            return $this->redirectToRoute('info_category');
        }


        return $this->render('main/fixedexpenses/createfixedexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
?>