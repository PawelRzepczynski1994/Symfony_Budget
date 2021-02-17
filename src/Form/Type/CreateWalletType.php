<?php
namespace App\Form\Type;

use App\Entity\Wallet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CreateWalletType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
        ->add('namewallet',TextType::class)
        ->add('description',TextType::class)
        ->add('number_account',TextType::class)
        ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    { 
        
    }
}