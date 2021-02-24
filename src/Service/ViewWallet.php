<?php

namespace App\Service;

use App\Repository\WalletsRepository;

class ViewWallet
{
    private WalletsRepository $walletRepository;

    public function __construct(WalletsRepository $walletRepository)
    {
        $this->walletRepository = $walletRepository;
    }
    
    public function viewWallets($user)
    {
        $wallets = $this->walletRepository->FindBy($user->getId());
        return $wallets;
    }
}

?>