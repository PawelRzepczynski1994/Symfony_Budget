<?php
namespace App\Controller;

use App\Entity\PlaceExpenses;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

class PlaceExpensesController extends AbstractController
{
    /**
    * @Route("/place_expenses", name="place_expenses")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $place_expenses = $this->getDoctrine()->getRepository(PlaceExpenses::class)->FindBy(['id_user' =>$this->getUser()->getId()]);

    
        return $this->render('main/placeexpenses/placeexpenses.html.twig',[
            'place_expenses' => $place_expenses
        ]);
    }

}
?>