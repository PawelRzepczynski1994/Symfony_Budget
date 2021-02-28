<?php
namespace App\Controller;

use App\Form\Type\CreateExpensesType;
use App\Service\CreateFixedExpenses;
use App\Service\EditFixedExpenses;
use App\Service\DeleteFixedExpenses;
use App\Service\ViewFixedExpenses;

use App\Form\Type\CreateFixedExpensesType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FixedExpensesController extends AbstractController
{
    private CreateFixedExpenses $createFixedExpenses;
    private EditFixedExpenses $editFixedExpenses;
    private DeleteFixedExpenses $deleteFixedExpenses;
    private ViewFixedExpenses $viewFixedExpenses;
    private SessionInterface $session;

    public function __construct(
        CreateFixedExpenses $createFixedExpenses,
        EditFixedExpenses $editFixedExpenses,
        DeleteFixedExpenses $deleteFixedExpenses,
        ViewFixedExpenses $viewFixedExpenses,
        SessionInterface $session
    )
    {
        $this->createFixedExpenses = $createFixedExpenses;
        $this->editFixedExpenses = $editFixedExpenses;
        $this->deleteFixedExpenses = $deleteFixedExpenses;
        $this->viewFixedExpenses = $viewFixedExpenses;
        $this->session = $session;
    }

    /**
    * @Route("/fixed_expenses", name="fixed_expenses")
    */
    public function viewFixedExpenses()
    {
        $user = $this->getUser();
        $fixed_expenses = $this->viewFixedExpenses->viewFixedExpenses($user);
        return $this->render('main/fixedexpenses/fixedexpenses.html.twig',[
            'fixed_expenses' => $fixed_expenses,
        ]);
    }
    /**
    * @Route("/createfixed_expenses", name="createfixed_expenses")
    */
    public function addFixedExpenses(Request $request)
    {
        $form = $this->createForm(CreateFixedExpensesType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->createFixedExpenses->create($this->getUser(),$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }
        return $this->render('main/fixedexpenses/createfixedexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    public function editFixedExpenses()
    {

    }
    public function deleteFixedExpenses()
    {

    }
}
?>