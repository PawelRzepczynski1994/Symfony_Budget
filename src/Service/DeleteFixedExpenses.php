<?php

namespace App\Service;

use App\Repository\FixedExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeleteFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct
    (
        FixedExpensesRepository $fixedExpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->fixedexpensesRepository = $fixedExpensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function delete($user, $id)
    {
        $check_fixedexpenses = $this->fixedexpensesRepository->findOneBy(['id' => $id]);
        if (!$check_fixedexpenses and $check_fixedexpenses->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.delete.cant'));
            return true;
        }
        $this->fixedexpensesRepository->remove($check_fixedexpenses);
        $this->session->set('error', $this->translatorInterface->trans('fixedexpenses.delete.ready'));
        return true;
    }
}

?>