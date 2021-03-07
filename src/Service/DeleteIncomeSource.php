<?php
namespace App\Service;

use App\Entity\SourceIncome;
use App\Repository\SourceIncomeRepository;

use Symfony\Component\HttpFoundation\Session\SessionInterface;

class DeleteIncomeSource
{
    private SourceIncomeRepository $sourceincomeRepository;
    private SessionInterface $session;
    public function __construct(SourceIncomeRepository $sourceIncomeRepository,SessionInterface $session)
    {
        $this->sourceincomeRepository = $sourceIncomeRepository;
        $this->session = $session;
    }

    public function delete($user,$id)
    {
        $check_sourceincome = $this->sourceincomeRepository->findOneById(['id' => $id]);
        if(!$check_sourceincome AND $check_sourceincome->getIdUser() != $user)
        {
            $this->session->set('error','Nie możesz skasować tego wydatku stałego!');
            return true;
        }
        $this->sourceincomeRepository->remove($check_sourceincome);
        $this->session->set('error','Wydatek stały został skasowany!');
        return true;
    }
}

?>