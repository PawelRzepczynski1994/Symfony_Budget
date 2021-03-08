<?php

namespace App\Service;

use App\Entity\SourceIncome;
use App\Repository\SourceIncomeRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct
    (
        SourceIncomeRepository $sourceincomeRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->sourceincomeRepository = $sourceincomeRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function create($user, $data)
    {
        $incomesource = $this->sourceincomeRepository->countSourcePlace($data["name"]);
        if ($incomesource != 0) {
            $this->session->set('error', $this->translatorInterface->trans('incomesource.create.already'));
            return true;
        }
        $source_income = new SourceIncome();
        $source_income->setUser($user);
        $source_income->setName($data["name"]);
        $source_income->setDescription($data["description"]);
        $this->sourceincomeRepository->save($source_income);
        $this->session->set('error', $this->translatorInterface->trans('incomesource.create.ready'));
        return true;
    }
}

?>