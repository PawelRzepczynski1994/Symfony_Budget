<?php
namespace App\Controller;

use App\Service\CreatePlacesExpenses;
use App\Service\EditPlacesExpenses;
use App\Service\DeletePlacesExpenses;
use App\Service\ViewPlacesExpenses;

use App\Form\Type\CreatePlaceExpensesType;
use App\Form\Type\EditPlaceExpensesType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PlaceExpensesController extends AbstractController
{
    private CreatePlacesExpenses $createPlacesExpenses;
    private EditPlacesExpenses $editPlacesExpenses;
    private DeletePlacesExpenses $deletePlacesExpenses;
    private ViewPlacesExpenses $viewPlacesExpenses;
    private SessionInterface $session;

    public function __construct(
        CreatePlacesExpenses $createPlacesExpenses,
        EditPlacesExpenses $editPlacesExpenses,
        DeletePlacesExpenses $deletePlacesExpenses,
        ViewPlacesExpenses $viewPlacesExpenses,
        SessionInterface $session
    )
    {
        $this->createPlacesExpenses = $createPlacesExpenses;
        $this->editPlacesExpenses = $editPlacesExpenses;
        $this->deletePlacesExpenses = $deletePlacesExpenses;
        $this->viewPlacesExpenses = $viewPlacesExpenses;
        $this->session = $session;
    }
    /**
    * @Route("/place_expenses", name="place_expenses")
    */
    public function viewPlacesExpenses(){
        $user = $this->getUser();
        $place_expenses = $this->viewPlacesExpenses->viewPlacesExpenses($user);
        return $this->render('main/placeexpenses/placeexpenses.html.twig',[
            'place_expenses' => $place_expenses
        ]);
    }
    /**
    * @Route("/create_placesexpenses", name="create_placesexpenses")
    */
    public function addPlacesExpenses(Request $request)
    {
        $form = $this->createForm(CreatePlaceExpensesType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->createPlacesExpenses->create($this->getUser(),$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }
        return $this->render('main/placeexpenses/createplaceexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    
    public function editPlacesExpenses(Request $request,PlaceExpenses $id)
    {
        $form = $this->createForm(EditPlaceExpensesType::class,$id)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->editPlacesExpenses->edit($this->getUser(),$id,$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }
        return $this->render('main/placeexpenses/editplaceexpenses.html.twig',[
            'form' => $form->createView(),
        ]);
    }
    public function deletePlacesExpenses($id)
    {
        $id = (int)$id;
        $this->deletePlacesExpenses->delete($this->getUser(),$id);
        return $this->redirectToRoute('info_category');
    }

}
?>