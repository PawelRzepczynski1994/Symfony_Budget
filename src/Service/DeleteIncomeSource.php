<?php

namespace App\Service;

use App\Repository\SourceIncomeRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeleteIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct(
        SourceIncomeRepository $sourceIncomeRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->sourceincomeRepository = $sourceIncomeRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function delete($user, $id)
    {
        $check_sourceincome = $this->sourceincomeRepository->findOneById(['id' => $id]);
        if (!$check_sourceincome and $check_sourceincome->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('incomesource.delete.cant'));
            return true;
        }
        $this->sourceincomeRepository->remove($check_sourceincome);
        $this->session->set('error', $this->translatorInterface->trans('incomesource.delete.ready'));
        return true;
    }
}

?>