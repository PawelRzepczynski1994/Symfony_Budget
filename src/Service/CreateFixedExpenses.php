<?php
namespace App\Service;

use App\Entity\FixedExpenses;
use App\Repository\FixedExpensesRepository;

class CreateFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    public function __construct(FixedExpensesRepository $fixedexpensesRepository)
    {
        $this->fixedexpensesRepository = $fixedexpensesRepository;
    }

    public function create($user,$data)
    {
        $fixedexpenses = $this->fixedexpensesRepository->countNameFixedExpenses($data["name"]);
        if($fixedexpenses != 0)
        {
            return false;
        }
        $expense = new FixedExpenses();
        $expense->setName($data["name"]);
        $expense->setIdUser($user->getId());
        $expense->setIdCategory($data["category"]->getId());
        $expense->setIdPlaceExpenses($data["place_expenses"]->getId());
        $expense->setIdWallet($data["wallet"]->getId());
        $expense->setFirstDate($data["first_date"]->getTimestamp());
        $expense->setFrequencyPayments($data["frequency_payments"]);
        $expense->setDescription($data["description"]);
        $expense->setAmount($data["amount"]);
        $expense->setActive($data["active"]);
        $this->fixedexpensesRepository->save($expense);
        return true;
    }
}

?>