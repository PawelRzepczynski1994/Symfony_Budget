<?php
namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;

    public function __construct(WalletsRepository $walletsRepository,SessionInterface $session)
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
    }

    public function edit($user,$id,$data)
    {
        $check_wallet = $this->walletsRepository->findOneById(['id' => $id]);
        if(!$check_wallet AND $check_wallet->getIdUser() != $user){
            $this->session->set('error','Nie możesz edytować tego portfela!');
            return false;
        }
        $check_wallet->setName($data->getName());
        $check_wallet->setIdBankAccount($data->getIdBankAccount());
        $check_wallet->setDescription($data->getDescription());
        $this->walletsRepository->update();
        $this->session->set('error','Zaktualizowałeś informację o portfelu!');
        return true;
    }
}
?>