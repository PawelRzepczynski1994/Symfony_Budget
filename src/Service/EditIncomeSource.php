<?php
namespace App\Service;

use App\Entity\SourceIncome;
use App\Repository\SourceIncomeRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class EditIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;
    private SessionInterface $session;
    public function __construct(SourceIncomeRepository $sourceIncomeRepository,SessionInterface $session)
    {
        $this->sourceincomeRepository = $sourceIncomeRepository;
        $this->session = $session;
    }

    public function edit($user,$id,$data)
    {
        $check_source = $this->sourceincomeRepository->findOneBy(['id' => $id]);
        if(!$check_source AND $check_source->getIdUser() != $user){
            $this->session->set('error','Nie możesz edytować tego źródła dochodu!');
            return false;
        }
        $check_source->setName($data->getName());
        $check_source->setDescription($data->getDescription());
        $this->sourceincomeRepository->update();
        $this->session->set('error','Zaktualizowałeś informację o źródle dochodu!');
        return true;
    }
}
?>