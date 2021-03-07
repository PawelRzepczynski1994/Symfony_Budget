<?php
namespace App\Service;

use App\Entity\Expenses;
use App\Repository\ExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateExpenses{

    private ExpensesRepository $expensesRepository;
    private SessionInterface $session;

    public function __construct(ExpensesRepository $expensesRepository,SessionInterface $session)
    {
        $this->expensesRepository = $expensesRepository;
        $this->session = $session;
    }

    public function create($user,$data)
    {
        $expense = new Expenses();
        $expense->setIdUser($user->getId());
        $expense->setIdCategory($data["category"]->getId());
        $expense->setIdPlaceExpenses($data["place_expenses"]->getId());
        $expense->setIdWallet($data["wallet"]->getId());
        $expense->setDate($data["date_start"]->getTimestamp());
        $expense->setDescription($data["description"]);
        $expense->setAmount($data["amount"]);
        $this->expensesRepository->save($expense);
        $this->session->set('error', 'Utworzyłeś nowy wydatek!');
        return true;
    }
}

?>