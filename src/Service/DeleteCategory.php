<?php
namespace App\Service;

use App\Repository\CategoryRepository;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class DeleteCategory
{
    private CategoryRepository $categoryRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;

    public function __construct
    (
        CategoryRepository $categoryRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
    }

    public function delete($user,$id)
    {
        $check_category = $this->categoryRepository->findOneBy(['id' => $id]);
        if(!$check_category AND $check_category->getUser() != $user)
        {
            $this->session->set('error','Blad');
            return true;
        }
        $this->categoryRepository->remove($check_category);
        $this->session->set('error','Udalo sie');
        return true;
    }
}

?>