<?php

namespace App\Service;

use App\Repository\ExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeleteExpenses
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

    public function delete($user, $id)
    {
        $check_expenses = $this->expensesRepository->findOneBy(['id' => $id]);
        if (!$check_expenses and $check_expenses->getIdUser() != $user) {
            $this->session('error', $this->translatorInterface->trans('expenses.delete.cant'));
            return true;
        }
        $this->expensesRepository->remove($check_expenses);
        $this->session->set('error', $this->translatorInterface->trans('expenses.delete.ready'));
        return true;
    }
}

?>