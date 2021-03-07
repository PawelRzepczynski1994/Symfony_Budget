<?php
namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeleteWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;
    public function __construct(WalletsRepository $walletsRepository,SessionInterface $session)
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
    }
    public function delete($user,$id)
    {
        $check_wallet = $this->walletsRepository->findOneById(['id' => $id]);
        if(!$check_wallet AND $check_wallet->getIdUser() != $user){
            $this->session->set('error','Nie możesz skasować tego portfela!');
            return true;
        }
        $this->walletsRepository->remove($check_wallet);
        $this->session->set('error','Portfel został skasowany!');
        return true;
    }
}
?>