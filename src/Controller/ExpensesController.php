<?php
namespace App\Controller;

use App\Service\CreateExpenses;
use App\Service\EditExpenses;
use App\Service\DeleteExpenses;
use App\Service\ViewExpenses;

use App\Form\Type\CreateExpensesType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExpensesController extends AbstractController
{
    private CreateExpenses $createExpenses;
    private EditExpenses $editExpenses;
    private DeleteExpenses $deleteExpenses;
    private ViewExpenses $viewExpenses;
    private SessionInterface $session;

    public function __construct(
        CreateExpenses $createExpenses,
        EditExpenses $editExpenses,
        DeleteExpenses $deleteExpenses,
        ViewExpenses $viewExpenses,
        SessionInterface $session
    )
    {
        $this->createExpenses = $createExpenses;
        $this->editExpenses = $editExpenses;
        $this->deleteExpenses = $deleteExpenses;
        $this->viewExpenses = $viewExpenses;
        $this->session = $session;
    }

    /**
    * @Route("/expenses", name="expenses")
    */
    public function viewExpenses(){
        $user = $this->getUser();
        $expenses = $this->viewExpenses->viewExpenses($user);
        return $this->render('main/expenses/expenses.html.twig',[
            'expenses' => $expenses,
        ]);
    }

    public function addExpenses(Request $request)
    {
        $form = $this->createForm(CreateExpensesType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $result = $this->createExpenses->create($this->getUser(),$data);
            $this->session->set('error', 'Utworzyłeś nowy wydatek!');
            return $this->redirectToRoute('info_category');
        }
        return $this->render('main/expenses/createexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function editExpenses()
    {

    }

    public function deleteExpenses()
    {

    }
}
?>