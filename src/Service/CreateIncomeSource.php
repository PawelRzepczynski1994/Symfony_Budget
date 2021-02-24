<?php
namespace App\Service;

use App\Entity\SourceIncome;
use App\Repository\SourceIncomeRepository;

class CreateIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;    
    public function __construct(SourceIncomeRepository $sourceincomeRepository)
    {
        $this->sourceincomeRepository = $sourceincomeRepository;
    }
    public function create($user,$data)
    {
        $incomesource = $this->sourceincomeRepository->countSourcePlace($data["name"]);
        if($incomesource != 0)
        {
            return false;
        }
        $source_income = new SourceIncome();
        $source_income->setIdUser($user->getId());
        $source_income->setName($data["name"]);
        $source_income->setDescription($data["description"]);
        $this->sourceincomeRepository->save($source_income);
        return true;
    }
}

?>