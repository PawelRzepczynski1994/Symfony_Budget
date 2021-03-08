<?php

namespace App\Service;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class CreateCategory
{
    private CategoryRepository $categoryRepository;
    private SessionInterface $session;
    private ValidatorInterface $validatorInterface;
    private ErrorFormatter $errorFormatter;
    private TranslatorInterface $translatorInterface;

    public function __construct(
        CategoryRepository $categoryRepository,
        SessionInterface $session,
        ValidatorInterface $validatorInterface,
        ErrorFormatter $errorFormatter,
        TranslatorInterface $translatorInterface)
    {
        $this->categoryRepository = $categoryRepository;
        $this->session = $session;
        $this->validatorInterface = $validatorInterface;
        $this->errorFormatter = $errorFormatter;
        $this->translatorInterface = $translatorInterface;
    }

    public function create($user, $data)
    {
        $category = $this->categoryRepository->countNameCategory($data["namecategory"]);
        if ($category != 0) {
            $this->session->set('error', $this->translatorInterface->trans('category.name.already'));
            return true;
        }
        $category = new Category($user, $data["namecategory"]);
        $errors = $this->validatorInterface->validate($category);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }

        $this->categoryRepository->save($category);
        $this->session->set('error', $this->translatorInterface->trans('category.name.ready'));
        return true;
    }
}

?>