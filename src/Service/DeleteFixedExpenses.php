<?php
namespace App\Service;

use App\Entity\FixedExpenses;
use App\Repository\FixedExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeleteFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;

    public function __construct(FixedExpensesRepository $fixedExpensesRepository,SessionInterface $session)
    {
        $this->fixedexpensesRepository = $fixedExpensesRepository;
        $this->session = $session;
    }

    public function delete($user,$id)
    {
        $check_fixedexpenses = $this->fixedexpensesRepository->findOneBy(['id' => $id]);
        if(!$check_fixedexpenses AND $check_fixedexpenses->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz skasować tego wydatku stałego!');
            return true;
        }
        $this->fixedexpensesRepository->remove($check_fixedexpenses);
        $this->session->set('error','Wydatek stały został skasowany!');
        return true;
    }
}

?>