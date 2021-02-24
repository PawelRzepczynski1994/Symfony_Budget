<?php
namespace App\Controller;

use App\Service\CreateWallet;
use App\Service\EditWallet;
use App\Service\DeleteWallet;
use App\Service\ViewWallet;

use App\Form\Type\CreateWalletType;

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
    public function viewWallets(){
        $user = $this->getUser();
        $wallets = $this->viewWallet->viewWallets($user);
        return $this->render('main/wallets/wallets.html.twig',[
            'wallets' => $wallets,
        ]);
    }

   /**
    * @Route("/create_wallet", name="create_wallet")
    */
    public function addWallet(Request $request)
    {
        $form = $this->createForm(CreateWalletType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $result = $this->createWallet->create($this->getUser(),$data);
            if(!$result)
            {
                $this->session->set('error','Posiadasz już taki portfel!');
                return $this->redirectToRoute('info_category');
            }
            $this->session->set('error','Utworzyłeś nowy portfel:'.$data['namewallet']);
            return $this->redirectToRoute('info_category');
        }
        return $this->render('main/createcategory/create_category.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    public function editWallet(){

    }

    public function deleteWallet(){

    }
}
?>