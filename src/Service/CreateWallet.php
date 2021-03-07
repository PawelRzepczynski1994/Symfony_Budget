<?php
namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;

    public function __construct(WalletsRepository $walletsRepository,SessionInterface $session)
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
    }
    
    public function create($user,$data)
    {
        $wallet = $this->walletsRepository->countNumberWallets($data["namewallet"]);
        if($wallet != 0){
            $this->session->set('error','Posiadasz już taki portfel!');
            return true;
        }
        $wallet = new Wallets();
        $wallet->setIdUser($user->getId());
        $wallet->setName($data["namewallet"]);
        $wallet->setDescription($data["description"]);
        $wallet->setIdBankAccount($data["number_account"]);
        $this->walletsRepository->save($wallet);
        $this->session->set('error','Utworzyłeś nowy portfel:'.$data['namewallet']);
        return true;
    }
}

?>