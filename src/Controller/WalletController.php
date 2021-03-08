<?php
namespace App\Controller;

use App\Service\CreateWallet;
use App\Service\EditWallet;
use App\Service\DeleteWallet;
use App\Service\ViewWallet;

use App\Form\Type\CreateWalletType;
use App\Form\Type\EditWalletType;


use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class WalletController extends AbstractController
{
    private CreateWallet $createWallet;
    private EditWallet $editWallet;
    private DeleteWallet $deleteWallet;
    private ViewWallet $viewWallet;
    private SessionInterface $session;

    public function __construct(
        CreateWallet $createWallet,
        EditWallet $editWallet,
        DeleteWallet $deleteWallet,
        ViewWallet $viewWallet,
        SessionInterface $session
    )
    {
        $this->createWallet = $createWallet;
        $this->editWallet = $editWallet;
        $this->deleteWallet = $deleteWallet;
        $this->viewWallet = $viewWallet;
        $this->session = $session;
    }
    /**
    * @Route("/wallet", name="wallet")
    */
    public function viewWallets()
    {
        $wallets = $this->getUser()->getWallets();
        return $this->render('main/wallets/wallets.html.twig',[
            'wallets' => $wallets,
        ]);
    }

   /**
    * @Route("/create_wallet", name="create_wallet")
    */
    public function addWallet(Request $request)
    {
        $form = $this->createForm(CreateWalletType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->createWallet->create($this->getUser(),$form->getData());
            if($result)
                return $this->redirectToRoute('info_category'); 
        }
        return $this->render('main/wallets/createwallets.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/edit_wallet/{id}", name="edit_wallet")
     */
    public function editWallet(Request $request,Wallets $id)
    {
        $form = $this->createForm(EditWalletType::class,$id)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->editWallet->edit($this->getUser(),$id,$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }
        return $this->render('main/wallets/editwallets.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    /**
     * @Route("/delete_wallet/{id}", name="delete_wallet")
     */
    public function deleteWallet($id)
    {
            $id = (int)$id;
            $this->deleteWallet->delete($this->getUser(), $id);
            return $this->redirectToRoute('info_category');

    }
}
?>