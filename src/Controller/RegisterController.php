<?php

namespace App\Controller;

use App\Entity\Users;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Form\Forms;
use Symfony\Component\Translation\Loader\XliffFileLoader;
use Symfony\Component\Translation\Translator;



class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passEncoder): Response
    {
        $form = $this->createFormBuilder()
                     ->add('username')
                     ->add('password', RepeatedType::class, [
                         'type' => PasswordType::class,
                         'required' => true,
                         'first_options' =>  ['label' => 'Password'],
                         'second_options' => ['label' => 'Confirm Password'] 
                     ])
                     ->add('email',EmailType::class)
                     ->add('register',SubmitType::class)
                     ->getForm();

        $form->handleRequest($request);
        if($form->isSubmitted()){
            $data = $form->getData();
            $user = new Users();
            $user->setUsername($data['username']);
            $user->setName($data["username"]);
            $user->setEmail($data['email']);
            $user->setPassword(
                $passEncoder->encodePassword($user,$data['password'])
            );
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            return $this->redirect($this->generateUrl('app_login'));
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
