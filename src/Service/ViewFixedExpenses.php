<?php

namespace App\Service;

use App\Repository\FixedExpensesRepository;

class ViewFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;

    public function __construct(FixedExpensesRepository $fixedExpensesRepository)
    {
        $this->fixedexpensesRepository = $fixedExpensesRepository;
    }

    public function viewFixedExpenses($user)
    {
        $fixedexpenses = $this->fixedexpensesRepository->ViewFixedExpenses($user->getId());
        return $fixedexpenses;
    }
}