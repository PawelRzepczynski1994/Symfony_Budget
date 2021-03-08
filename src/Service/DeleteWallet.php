<?php

namespace App\Service;

use App\Repository\WalletsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeleteWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct
    (
        WalletsRepository $walletsRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function delete($user, $id)
    {
        $check_wallet = $this->walletsRepository->findOneById(['id' => $id]);
        if (!$check_wallet and $check_wallet->getIdUser() != $user) {
            $this->session->set('error', $this->translatorInterface->trans('wallet.delete.cant'));
            return true;
        }
        $this->walletsRepository->remove($check_wallet);
        $this->session->set('error', $this->translatorInterface->trans('wallet.delete.ready'));
        return true;
    }
}

?>