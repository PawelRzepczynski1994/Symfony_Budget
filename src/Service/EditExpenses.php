<?php
namespace App\Service;

use App\Repository\ExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditExpenses
{
    private ExpensesRepository $expensesRepository;
    private SessionInterface $session;

    public function __construct(ExpensesRepository $expensesRepository,SessionInterface $session)
    {
        $this->expensesRepository = $expensesRepository;
        $this->session = $session;
    }

    public function edit($user,$id,$data)
    {
        $check_expenses = $this->expensesRepository->findOneBy(['id' => $id]);
        if(!$check_expenses AND $check_expenses->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz edytować tego wydatku!');
            return true;
        }
        $check_expenses->setCategory($data->getCategory());
        $check_expenses->setPlaceExpenses($data->getPlaceExpenses());
        $check_expenses->setWallets($data->getWallets());
        $check_expenses->setDate($data->getDate());
        $check_expenses->setDescription($data->getDescription());
        $check_expenses->setAmount($data->getAmount());
        $this->expensesRepository->update();
        $this->session->set('error','Edytowałeś wybrany wydatek!');
        return true;
    }
}

?>