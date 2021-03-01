<?php
namespace App\Service;

use App\Entity\PlaceExpenses;
use App\Repository\PlaceExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditPlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;
    private SessionInterface $session;

    public function __construct(PlaceExpensesRepository $placeExpensesRepository,SessionInterface $session)
    {
        $this->placeexpensesRepository = $placeExpensesRepository;
        $this->session = $session;
    }

    public function edit($user,$id,$data)
    {
        $check_placesexpenses = $this->placeexpensesRepository->findOneBy(['id' => $id]);
        if(!$check_placesexpenses AND $check_placesexpenses->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz edytować miejsca wydatków!');
            return false;
        }
        $check_placesexpenses->setName($data->getName());
        $check_placesexpenses->setAddress($data->getAddress());
        $check_placesexpenses->setAddress2($data->getAddress2());
        $check_placesexpenses->setNumberPhone($data->getNumberPhone());
        $check_placesexpenses->setEmail($data->getEmail());
        $check_placesexpenses->setDescription($data->getDescription());
        $this->placeexpensesRepository->update();
        $this->session->set('error','Zaktualizowałeś informacje o miejscach wydatków!');
        return true;
    }
}
?>