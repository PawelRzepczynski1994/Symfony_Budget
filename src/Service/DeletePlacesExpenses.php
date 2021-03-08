<?php

namespace App\Service;

use App\Repository\PlaceExpensesRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeletePlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct
    (
        PlaceExpensesRepository $placeExpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->placeexpensesRepository = $placeExpensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function delete($user, $id)
    {
        $check_placeexpenses = $this->placeexpensesRepository->findOneBy(['id' => $id]);
        if (!$check_placeexpenses and $check_placeexpenses->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('placesexpenses.delete.cant'));
            return true;
        }
        $this->placeexpensesRepository->remove($check_placeexpenses);
        $this->session->set('error', $this->translatorInterface->trans('placesexpenses.delete.ready'));
        return true;
    }
}

?>