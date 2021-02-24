<?php

namespace App\Service;

use App\Repository\ExpensesRepository;

class ViewExpenses
{
    private ExpensesRepository $expensesRepository;

    public function __construct(ExpensesRepository $expensesRepository)
    {
        $this->expensesRepository = $expensesRepository;
    }

    public function viewExpenses($user)
    {
        $expenses = $this->expensesRepository->ViewExpenses($user->getId());
        return $expenses;
    }
}

?>