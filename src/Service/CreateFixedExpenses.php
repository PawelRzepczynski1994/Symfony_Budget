<?php
namespace App\Service;

use App\Entity\FixedExpenses;
use App\Repository\FixedExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;

    public function __construct(FixedExpensesRepository $fixedexpensesRepository,SessionInterface $session)
    {
        $this->fixedexpensesRepository = $fixedexpensesRepository;
        $this->session = $session;
    }

    public function create($user,$data)
    {
        $fixedexpenses = $this->fixedexpensesRepository->countNameFixedExpenses($data["name"]);
        if($fixedexpenses)
        {
            $this->session->set('error','Posiadasz juz taki wydatek stały!');
            return true;
        }
        $expense = new FixedExpenses();
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
        $this->session->set('error','Utworzyłeś nowy wydatek stały: '.$data["name"]);
        return true;
    }
}

?>