<?php
namespace App\Controller;

use App\Entity\Wallets;
use App\Form\Type\CreateWalletType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;


class CreateWalletController extends AbstractController
{
    /**
    * @Route("/create_wallet", name="create_wallet")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $respository = $entityManager->getRepository(Wallets::class);

        $form = $this->createForm(CreateWalletType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $new_wallet = $form->getData();
            $wallet = $respository->countNumberWallets($new_wallet["namewallet"]);
            if($wallet != 0){
                $session->set('error','Posiadasz już taką nazwę portfela!');
                return $this->redirectToRoute('info_category');
            }
            $wallet = new Wallets();
            $wallet->setIdUser($this->getUser()->getId());
            $wallet->setName($new_wallet["namewallet"]);
            $wallet->setDescription($new_wallet["description"]);
            $wallet->setIdBankAccount($new_wallet["number_account"]);
            $entityManager->persist($wallet);
            $entityManager->flush();
            $session->set('error','Utworzyłeś nowy portfel:'.$new_wallet["namewallet"]);
            return $this->redirectToRoute('info_category');
        }
            return $this->render('main/wallets/createwallets.html.twig',[
                'form' => $form->createView(),
            ]);
    }

}
?>