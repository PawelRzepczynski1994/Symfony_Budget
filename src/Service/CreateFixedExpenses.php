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
        if($fixedexpenses != 0)
        {
            $this->session->get('error','Posiadasz juz taki wydatek stały!');
            return false;
        }
        $expense = new FixedExpenses();
        $expense->setName($data["name"]);
        $expense->setIdUser($user->getId());
        $expense->setIdCategory($data["category"]->getId());
        $expense->setIdPlaceExpenses($data["place_expenses"]->getId());
        $expense->setIdWallet($data["wallet"]->getId());
        $expense->setFirstDate($data["first_date"]->getTimestamp());
        $expense->setFrequencyPayments($data["frequency_payments"]);
        $expense->setDescription($data["description"]);
        $expense->setAmount($data["amount"]);
        $expense->setActive($data["active"]);
        $this->fixedexpensesRepository->save($expense);
        $this->session->get('error','Utworzyłeś nowy wydatek stały: '.$data["name"]);
        return true;
    }
}

?>