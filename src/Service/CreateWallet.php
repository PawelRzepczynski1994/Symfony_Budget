<?php
namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;

class CreateWallet
{
    private WalletsRepository $walletsRepository;

    public function __construct(WalletsRepository $walletsRepository)
    {
        $this->walletsRepository = $walletsRepository;
    }
    
    public function create($user,$data)
    {
        $wallet = $this->walletsRepository->countNumberWallets($data["namewallet"]);
        if($wallet != 0){
            return false;
        }
        $wallet = new Wallets();
        $wallet->setIdUser($user->getId());
        $wallet->setName($data["namewallet"]);
        $wallet->setDescription($data["description"]);
        $wallet->setIdBankAccount($data["number_account"]);
        $this->walletsRepository->save($wallet);
        return true;
    }
}

?>