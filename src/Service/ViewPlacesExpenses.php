<?php

namespace App\Service;

use App\Repository\PlaceExpensesRepository;

class ViewPlacesExpenses
{
    private PlaceExpensesRepository $placesexpensesRepository;

    public function __construct(PlaceExpensesRepository $placesexpensesRepository)
    {
        $this->placesexpensesRepository = $placesexpensesRepository;
    }

    public function viewPlacesExpenses($user)
    {
        $placesexpenses = $this->placesexpensesRepository->findbyUserId($user->getId());
        return $placesexpenses;
    }
}

?>