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
        $expense->setUser($user);
        $expense->setCategory($data["category"]);
        $expense->setPlaceExpenses($data["place_expenses"]);
        $expense->setWallets($data["wallet"]);
        $expense->setDate($data["date_start"]);
        $expense->setDescription($data["description"]);
        $expense->setAmount($data["amount"]);
        $this->expensesRepository->save($expense);
        $this->session->set('error', 'Utworzyłeś nowy wydatek!');
        return true;
    }
}

?>