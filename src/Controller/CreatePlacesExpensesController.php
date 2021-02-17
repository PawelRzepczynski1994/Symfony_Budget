<?php
namespace App\Controller;

use App\Form\Type\CreatePlaceExpensesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;


class CreatePlacesExpensesController extends AbstractController
{
    /**
    * @Route("/create_placesexpenses", name="create_placesexpenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {

        $form = $this->createForm(CreatePlaceExpensesType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {

        }
   
        return $this->render('main/placeexpenses/createplaceexpenses.html.twig',[
            'form' => $form->createView(),
    ]);
    }

}
?>