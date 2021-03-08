<?php

namespace App\Service;

use App\Repository\PlaceExpensesRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditPlacesExpenses
{
    private PlaceExpensesRepository $placeexpensesRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        PlaceExpensesRepository $placeExpensesRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->placeexpensesRepository = $placeExpensesRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function edit($user, $id, $data)
    {
        $check_placesexpenses = $this->placeexpensesRepository->findOneBy(['id' => $id]);
        if (!$check_placesexpenses and $check_placesexpenses->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('placesexpenses.edit.cant'));
            return true;
        }
        $check_placesexpenses->setName($data->getName());
        $check_placesexpenses->setAddress($data->getAddress());
        $check_placesexpenses->setAddress2($data->getAddress2());
        $check_placesexpenses->setNumberPhone($data->getNumberPhone());
        $check_placesexpenses->setEmail($data->getEmail());
        $check_placesexpenses->setDescription($data->getDescription());
        $errors = $this->validatorInterface->validate($check_placesexpenses);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->placeexpensesRepository->update();
        $this->session->set('error', $this->translatorInterface->trans('placesexpenses.edit.ready'));
        return true;
    }
}

?>