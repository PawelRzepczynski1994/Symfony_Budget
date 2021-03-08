<?php

namespace App\Service;

use App\Repository\FixedExpensesRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        FixedExpensesRepository $fixedExpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->fixedexpensesRepository = $fixedExpensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function edit($user, $id, $data)
    {
        $check_fixedexpenses = $this->fixedexpensesRepository->findOneBy(['id' => $id]);
        if (!$check_fixedexpenses and $check_fixedexpenses->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.edit.cant'));
            return true;
        }
        $check_fixedexpenses->setName($data->getName());
        $check_fixedexpenses->setIdCategory($data->getIdCategory());
        $check_fixedexpenses->setIdPlaceExpenses($data->getIdPlaceExpenses());
        $check_fixedexpenses->setIdWallet($data->getIdWallet());
        $check_fixedexpenses->setFirstDate($data->getFirstDate->getTimestamp());
        $check_fixedexpenses->setFrequencyPayments($data->getFrequencyPayments());
        $check_fixedexpenses->setDescription($data->getDescription());
        $check_fixedexpenses->setAmount($data->getAmount());
        $check_fixedexpenses->setActive($data->getActive());
        $errors = $this->validatorInterface->validate($check_fixedexpenses);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->fixedexpensesRepository->update();
        $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.edit.ready'));
        return true;
    }
}

?>