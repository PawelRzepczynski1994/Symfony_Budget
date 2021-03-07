<?php
namespace App\Service;

use App\Entity\PlaceExpenses;
use App\Repository\PlaceExpensesRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeletePlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;
    private SessionInterface $session;
    public function __construct(PlaceExpensesRepository $placeExpensesRepository,SessionInterface $session)
    {
        $this->placeexpensesRepository = $placeExpensesRepository;
        $this->session = $session;
    }
    public function delete($user,$id)
    {
        $check_placeexpenses = $this->placeexpensesRepository->findOneBy(['id' => $id]);
        if(!$check_placeexpenses AND $check_placeexpenses->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz skasować tego miejsca wydatku!');
            return true;
        }
        $this->placeexpensesRepository->remove($check_placeexpenses);
        $this->session->set('error','Miejsce wydatku zostało skasowane!');
        return true;
    }
}

?>