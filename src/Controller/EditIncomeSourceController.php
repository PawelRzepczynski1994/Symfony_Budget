<?php
namespace App\Controller;

use App\Form\Type\CreateSourceIncomeType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;


class EditIncomeSourceController extends AbstractController
{
    /**
    * @Route("/editincome_source", name="editincome_source")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $form = $this->createForm(CreateSourceIncomeType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
         
        }

        return $this->render('main/incomesource/editincomesource.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
?>