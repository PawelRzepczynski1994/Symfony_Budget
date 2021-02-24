<?php

namespace App\Service;

use App\Repository\SourceIncomeRepository;

class ViewIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;

    public function __construct(SourceIncomeRepository $sourceIncomeRepository)
    {
        $this->sourceincomeRepository = $sourceIncomeRepository;
    }

    public function viewIncomeSource($user)
    {
        $incomesource = $this->sourceincomeRepository->FindBy(['id_user' =>$user->getId()]);
        return $incomesource;
    }
}

?>