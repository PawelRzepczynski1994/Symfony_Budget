<?php
namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Expenses;
use App\Entity\PlaceExpenses;
use App\Entity\Wallets;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CreateExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
        ->add('date_start',DateType::class)
        ->add('category',EntityType::class,[
            'class' => Category::class,
            'choice_label' => function($category){
        return $category ? strtoupper($category->getName()) : '';
            },
        ])
        ->add('place_expenses',EntityType::class,[
            'class' => PlaceExpenses::class,
            'choice_label' => function($placeExpenses){
        return $placeExpenses ? strtoupper($placeExpenses->getName()) : '';
            },
        ])
        ->add('wallet',EntityType::class,[
            'class' => Wallets::class,
            'choice_label' => function($wallets){
        return $wallets ? strtoupper($wallets->getName()) : '';
            },
        ])
        ->add('description',TextType::class)
        ->add('amount',MoneyType::class)
        ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    { 
        
    }
}