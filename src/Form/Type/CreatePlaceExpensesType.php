<?php
namespace App\Form\Type;

use App\Entity\PlaceExpenses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreatePlaceExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
        ->add('name',TextType::class)
        ->add('address_1',TextType::class)
        ->add('address_2',TextType::class)
        ->add('number_phone',NumberType::class)
        ->add('email',EmailType::class)
        ->add('description',TextType::class)
        ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    { 
        
    }
}