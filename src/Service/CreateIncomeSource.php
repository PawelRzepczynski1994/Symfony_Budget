<?php
namespace App\Service;

use App\Entity\SourceIncome;
use App\Repository\SourceIncomeRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CreateIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;    
    private SessionInterface $session;

    public function __construct(SourceIncomeRepository $sourceincomeRepository,SessionInterface $session)
    {
        $this->sourceincomeRepository = $sourceincomeRepository;
        $this->session = $session;
    }
    public function create($user,$data)
    {
        $incomesource = $this->sourceincomeRepository->countSourcePlace($data["name"]);
        if($incomesource != 0)
        {
            $this->session->set('error','Posiadasz już takie źródło dochodu!');
            return true;
        }
        $source_income = new SourceIncome();
        $source_income->setUser($user);
        $source_income->setName($data["name"]);
        $source_income->setDescription($data["description"]);
        $this->sourceincomeRepository->save($source_income);
        $this->session->set('error','Utworzyłeś nowe źródło dochodu:'.$data['name']);
        return true;
    }
}

?>