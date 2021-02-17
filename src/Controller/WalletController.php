<?php
namespace App\Controller;

use App\Entity\Wallets;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Doctrine\ORM\EntityManagerInterface;

class WalletController extends AbstractController
{
    /**
    * @Route("/wallet", name="wallet")
    */
    public function index()
    {
        
        $wallets = $this->getDoctrine()->getRepository(Wallets::class)->FindBy(['id_user' =>$this->getUser()->getId()]);

        return $this->render('main/wallets/wallets.html.twig',[
            'wallets' => $wallets,
        ]);
    }

}
?>