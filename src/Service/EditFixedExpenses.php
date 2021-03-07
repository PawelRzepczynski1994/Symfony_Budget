<?php
namespace App\Service;

use App\Entity\FixedExpenses;
use App\Repository\FixedExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditFixedExpenses
{
    private FixedExpensesRepository $fixedexpensesRepository;
    private SessionInterface $session;
    public function __construct(FixedExpensesRepository $fixedExpensesRepository,SessionInterface $session)
    {
        $this->fixedexpensesRepository = $fixedExpensesRepository;
        $this->session = $session;
    }

    public function edit($user,$id,$data)
    {
        $check_fixedexpenses = $this->fixedexpensesRepository->findOneBy(['id' => $id]);
        if(!$check_fixedexpenses AND $check_fixedexpenses->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz edytować tego wydatku stałego!');
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
        $this->fixedexpensesRepository->update();
        $this->session->set('error','Zaktualizowałeś informację na temat wydatku stałego!');
        return true;
    }
}

?>