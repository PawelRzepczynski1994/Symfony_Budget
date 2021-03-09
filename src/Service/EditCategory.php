<?php
namespace App\Service;

use App\Repository\CategoryRepository;
use App\Utils\ErrorFormatter;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class EditCategory
{
    private CategoryRepository $categoryRepository;
    private SessionInterface $session;
    private TranslatorInterface $translatorInterface;
    private ErrorFormatter $errorFormatter;
    private ValidatorInterface $validatorInterface;

    public function __construct(
        CategoryRepository $categoryRepository,
        SessionInterface $session,
        TranslatorInterface $translatorInterface,
        ErrorFormatter $errorFormatter,
        ValidatorInterface $validatorInterface
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->session = $session;
        $this->translatorInterface = $translatorInterface;
        $this->errorFormatter = $errorFormatter;
        $this->validatorInterface = $validatorInterface;
    }

    public function edit($user,$id,$data)
    {
        $checkCategory = $this->categoryRepository->findOneBy(['id' => $id]);
        if(!$checkCategory AND $checkCategory->getUser() != $user)
        {
            $this->session->set('error','Blad');
            return true;
        }
        $checkCategory->setName($data->getName());
        $errors = $this->validatorInterface->validate($checkCategory);
        if ($errors->count() > 0){
            $this->session->set('error', $this->errorFormatter->formatError($errors));
            return true;
        }
        $this->categoryRepository->update();
        $this->session->set('error','Udalo sie');
        return true;
    }
}

?>