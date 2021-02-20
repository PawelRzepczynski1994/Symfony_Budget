<?php
namespace App\Controller;

use App\Entity\PlaceExpenses;
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
        $repository = $entityManager->getRepository(PlaceExpenses::class);

        $form = $this->createForm(CreatePlaceExpensesType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
                $new_placeexpenses = $form->getData();
                $place = $repository->countNamePlace($new_placeexpenses["name"]);
                if($place != 0){
                    $session->set('error', 'Posiadasz już takie miejsce!');
                    return $this->redirectToRoute('info_category');
                }
                $new_place = new PlaceExpenses();
                $new_place->setIdUser($this->getUser()->getId());
                $new_place->setName($new_placeexpenses["name"]);
                $new_place->setAddress($new_placeexpenses["address_1"]);
                $new_place->setAddress2($new_placeexpenses["address_2"]);
                $new_place->setNumberPhone($new_placeexpenses["number_phone"]);
                $new_place->setEmail($new_placeexpenses["email"]);
                $new_place->setDescription($new_placeexpenses["description"]);
                $entityManager->persist($new_place);
                $entityManager->flush();
                $session->set('error', 'Utworzyłeś nowe miejsce wydatków:'.$new_placeexpenses["name"]);
                return $this->redirectToRoute('info_category');
        }
   
        return $this->render('main/placeexpenses/createplaceexpenses.html.twig',[
            'form' => $form->createView(),
    ]);
    }

}
?>