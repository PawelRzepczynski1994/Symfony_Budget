<?php

namespace App\Service;

use App\Entity\Expenses;
use App\Repository\ExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateExpenses
{

    private ExpensesRepository $expensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    
    public function __construct
    (
        ExpensesRepository $expensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->expensesRepository = $expensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function create($user, $data)
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
        $this->session->set('error', $this->translatorInterface->trans('expenses.create.ready'));
        return true;
    }
}

?>