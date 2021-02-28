<?php
namespace App\Controller;

use App\Service\CreateIncomeSource;
use App\Service\EditIncomeSource;
use App\Service\DeleteIncomeSource;
use App\Service\ViewIncomeSource;

use App\Form\Type\CreateSourceIncomeType;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class IncomeSourceController extends AbstractController
{
    private CreateIncomeSource $createIncomeSource;
    private EditIncomeSource $editIncomeSource;
    private DeleteIncomeSource $deleteIncomeSource;
    private ViewIncomeSource $viewIncomeSource;
    private SessionInterface $session;

    public function __construct(
        CreateIncomeSource $createIncomeSource,
        EditIncomeSource $editIncomeSource,
        DeleteIncomeSource $deleteIncomeSource,
        ViewIncomeSource $viewIncomeSource,
        SessionInterface $session
    )
    {
        $this->createIncomeSource = $createIncomeSource;
        $this->editIncomeSource = $editIncomeSource;
        $this->deleteIncomeSource = $deleteIncomeSource;
        $this->viewIncomeSource = $viewIncomeSource;
        $this->session = $session;
    }
    /**
    * @Route("/income_source", name="income_source")
    */
    public function viewIncomeSource()
    {
        $user = $this->getUser();
        $sourceincome = $this->viewIncomeSource->viewIncomeSource($user);
        return $this->render('main/incomesource/incomesource.html.twig',[
            'income_source' => $sourceincome
        ]);
    }
    public function addIncomeSource(Request $request)
    {
        $form = $this->createForm(CreateSourceIncomeType::class)->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $result = $this->createIncomeSource->create($this->getUser(),$form->getData());
            if($result)
                return $this->redirectToRoute('info_category');
        }
        return $this->render('main/incomesource/createincomesource.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    public function editIncomeSource()
    {

    }

    public function deleteIncomeSource()
    {

    }


}
?>