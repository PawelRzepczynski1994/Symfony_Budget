<?php
namespace App\Service;

use App\Entity\Expenses;
use App\Repository\ExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeleteExpenses
{
    private ExpensesRepository $expensesRepository;
    private SessionInterface $session;

    public function __construct(ExpensesRepository $expensesRepository,SessionInterface $session)
    {
        $this->expensesRepository = $expensesRepository;
        $this->session = $session;
    }
    public function delete($user,$id)
    {
        $check_expenses = $this->expensesRepository->findOneBy(['id' => $id]);
        if(!$check_expenses AND $check_expenses->getIdUser() != $user)
        {
            $this->session('error','Nie możesz skasować tego wydatku!');
            return true;
        }
        $this->expensesRepository->remove($check_expenses);
        $this->session->set('error','Skasowałeś wybrany wydatek!');
        return true;
    }
}
?>