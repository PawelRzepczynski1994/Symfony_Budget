<?php
namespace App\Form\Type;

use App\Entity\FixedExpenses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class CreateFixedExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
        ->add('name',TextType::class)
        ->add('id_category',TextType::class)
        ->add('id_place_expenses',TextType::class)
        ->add('id_wallet',TextType::class)
        ->add('first_date',DateType::class)
        ->add('frequency_payments',TextType::class)
        ->add('description',TextType::class)
        ->add('amount',MoneyType::class)
        ->add('active',CheckboxType::class)
        ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    { 
        
    }
}