<?php

namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInteface;

    public function __construct
    (
        WalletsRepository $walletsRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInteface
    )
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
        $this->translatorInteface = $translatorInteface;
    }

    public function create($user, $data)
    {
        $wallet = $this->walletsRepository->countNumberWallets($data["namewallet"]);
        if ($wallet != 0) {
            $this->session->set('error', $this->translatorInteface->trans('wallet.create.already'));
            return true;
        }
        $wallet = new Wallets();
        $wallet->setUser($user);
        $wallet->setName($data["namewallet"]);
        $wallet->setDescription($data["description"]);
        $wallet->setBankAccount($data["number_account"]);
        $this->walletsRepository->save($wallet);
        $this->session->set('error', $this->translatorInteface->trans('wallet.create.ready'));
        return true;
    }
}

?>