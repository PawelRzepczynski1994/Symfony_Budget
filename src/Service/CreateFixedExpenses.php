<?php

namespace App\Service;

use App\Entity\FixedExpenses;
use App\Repository\FixedExpensesRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;


class CreateFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        FixedExpensesRepository $fixedexpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->fixedexpensesRepository = $fixedexpensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function create($user, $data)
    {
        $fixedexpenses = $this->fixedexpensesRepository->countNameFixedExpenses($data["name"]);
        if ($fixedexpenses) {
            $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.create.already'));
            return true;
        }
        $expense = new FixedExpenses();
        $errors = $this->validatorInterface->validate($expense);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $expense->setName($data["name"]);
        $expense->setUser($user);
        $expense->setCategory($data["category"]);
        $expense->setPlaceExpenses($data["place_expenses"]);
        $expense->setWallets($data["wallet"]);
        $expense->setFirstDate($data["first_date"]);
        $expense->setFrequencyPayments($data["frequency_payments"]);
        $expense->setDescription($data["description"]);
        $expense->setAmount($data["amount"]);
        $expense->setActive($data["active"]);
        $this->fixedexpensesRepository->save($expense);
        $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.create.ready'));
        return true;
    }
}

?>