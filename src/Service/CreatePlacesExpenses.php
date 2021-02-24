<?php

namespace App\Service;

use App\Entity\PlaceExpenses;
use App\Repository\PlaceExpensesRepository;

class CreatePlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;

    public function __construct(PlaceExpensesRepository $placeexpensesRepository)
    {
        $this->placeexpensesRepository = $placeexpensesRepository;
    }

    public function create($user,$data)
    {
        $placeexpenses = $this->placeexpensesRepository->countNamePlace($data['name']);
        if($placeexpenses != 0)
        {
            return false;
        }
        $new_place = new PlaceExpenses();
        $new_place->setIdUser($user->getId());
        $new_place->setName($data["name"]);
        $new_place->setAddress($data["address_1"]);
        $new_place->setAddress2($data["address_2"]);
        $new_place->setNumberPhone($data["number_phone"]);
        $new_place->setEmail($data["email"]);
        $new_place->setDescription($data["description"]);
        $this->placeexpensesRepository->save($new_place);
        return true;
    }
}

?>