<?php

namespace App\Service;

use App\Repository\SourceIncomeRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        SourceIncomeRepository $sourceIncomeRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->sourceincomeRepository = $sourceIncomeRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function edit($user, $id, $data)
    {
        $check_source = $this->sourceincomeRepository->findOneBy(['id' => $id]);
        if (!$check_source and $check_source->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('incomesource.edit.cant'));
            return true;
        }
        $check_source->setName($data->getName());
        $check_source->setDescription($data->getDescription());
        $errors = $this->validatorInterface->validate($check_source);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->sourceincomeRepository->update();
        $this->session->set('error', $this->translatorInterface->trans('incomesource.edit.ready'));
        return true;
    }
}

?>