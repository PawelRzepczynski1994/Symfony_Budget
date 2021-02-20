<?php
namespace App\Controller;

use App\Entity\SourceIncome;
use App\Form\Type\CreateSourceIncomeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class CreateIncomeSourceController extends AbstractController
{
    /**
    * @Route("/create_incomesource", name="create_incomesource")
    */
    public function index(Request $request,EntityManagerInterface $entityManager,SessionInterface $session): Response
    {
        $repository = $entityManager->getRepository(SourceIncome::class);

        $form = $this->createForm(CreateSourceIncomeType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $new_sourceincome = $form->getData();
            $c_sourceincome = $repository->countSourcePlace($new_sourceincome["name"]);
            if($c_sourceincome != 0){
                $session->set('error', 'Posiadasz już takie źródło dochodu!');
                return $this->redirectToRoute('info_category');
            }
            $source_income = new SourceIncome();
            $source_income->setIdUser($this->getUser()->getId());
            $source_income->setName($new_sourceincome["name"]);
            $source_income->setDescription($new_sourceincome["description"]);
            $entityManager->persist($source_income);
            $entityManager->flush();
            $session->set('error', 'Utworzyłeś nowe źródło dochodów:'.$new_sourceincome["name"]);
            return $this->redirectToRoute('info_category');
        }

        return $this->render('main/incomesource/createincomesource.html.twig',[
            'form' => $form->createView(),
        ]);
    }

}
?>