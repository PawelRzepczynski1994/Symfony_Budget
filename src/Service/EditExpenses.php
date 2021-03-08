<?php

namespace App\Service;

use App\Repository\ExpensesRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditExpenses
{
    private ExpensesRepository $expensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        ExpensesRepository $expensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->expensesRepository = $expensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function edit($user, $id, $data)
    {
        $check_expenses = $this->expensesRepository->findOneBy(['id' => $id]);
        if (!$check_expenses and $check_expenses->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('expenses.edit.cant'));
            return true;
        }
        $check_expenses->setCategory($data->getCategory());
        $check_expenses->setPlaceExpenses($data->getPlaceExpenses());
        $check_expenses->setWallets($data->getWallets());
        $check_expenses->setDate($data->getDate());
        $check_expenses->setDescription($data->getDescription());
        $check_expenses->setAmount($data->getAmount());
        $errors = $this->validatorInterface->validate($check_expenses);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->expensesRepository->update();
        $this->session->set('error', $this->translatorInterface->trans('expenses.edit.ready'));
        return true;
    }
}

?>