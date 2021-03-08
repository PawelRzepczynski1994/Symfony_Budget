<?php
namespace App\Service;

use App\Entity\Wallets;
use App\Repository\WalletsRepository;

use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditWallet
{
    private WalletsRepository $walletsRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;

    public function __construct
    (
        WalletsRepository $walletsRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter
    )
    {
        $this->walletsRepository = $walletsRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
    }

    public function edit($user,$id,$data)
    {
        $check_wallet = $this->walletsRepository->findOneById(['id' => $id]);
        if(!$check_wallet AND $check_wallet->getIdUser() != $user){
            $this->session->set('error',$this->translatorInterface->trans('wallet.edit.cant'));
            return true;
        }
        $check_wallet->setName($data->getName());
        $check_wallet->setIdBankAccount($data->getIdBankAccount());
        $check_wallet->setDescription($data->getDescription());
        $errors = $this->validatorInterface->validate($check_wallet);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->walletsRepository->update();
        $this->session->set('error',$this->translatorInterface->trans('wallet.edit.ready'));
        return true;
    }
}
?>