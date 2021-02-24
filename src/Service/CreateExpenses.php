<?php
namespace App\Service;

use App\Entity\Expenses;
use App\Repository\ExpensesRepository;

class CreateExpenses{
    private ExpensesRepository $expensesRepository;
    public function __construct(ExpensesRepository $expensesRepository)
    {
        $this->expensesRepository = $expensesRepository;
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
        return true;
    }
}

?>