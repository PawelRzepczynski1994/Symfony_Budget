<?php

namespace App\Service;

use App\Entity\PlaceExpenses;
use App\Repository\PlaceExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreatePlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translationInterface;

    public function __construct
    (
        PlaceExpensesRepository $placeexpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translationInterface
    )
    {
        $this->placeexpensesRepository = $placeexpensesRepository;
        $this->session = $session;
        $this->translationInterface = $translationInterface;
    }

    public function create($user, $data)
    {
        $placeexpenses = $this->placeexpensesRepository->countNamePlace($data['name']);
        if ($placeexpenses != 0) {
            $this->session->get('error', $this->translationInterface->trans('placesexpenses.create.already'));
            return true;
        }
        $new_place = new PlaceExpenses();
        $new_place->setUser($user);
        $new_place->setName($data["name"]);
        $new_place->setAddress($data["address_1"]);
        $new_place->setAddress2($data["address_2"]);
        $new_place->setNumberPhone($data["number_phone"]);
        $new_place->setEmail($data["email"]);
        $new_place->setDescription($data["description"]);
        $this->placeexpensesRepository->save($new_place);
        $this->session->set('error', $this->translationInterface->trans('placesexpenses.create.ready'));
        return true;
    }
}

?>