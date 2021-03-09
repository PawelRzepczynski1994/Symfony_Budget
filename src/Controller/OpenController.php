<?php
namespace App\Controller;

use App\Repository\ExpensesRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OpenController extends AbstractController
{
    private ExpensesRepository $expensesRepository;

    public function __construct(ExpensesRepository $expensesRepository)
    {
        $this->expensesRepository = $expensesRepository;
    }

    public function viewCategory($id)
    {
        $information = $this->expensesRepository->ViewInformation($this->getUser()->getId(),$id);
        return $this->render('main/view/information.html.twig',[
            'information' => $information
        ]);

    }

}