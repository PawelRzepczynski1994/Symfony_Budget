<?php
namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\PlaceExpenses;
use App\Entity\Wallets;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EditFixedExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('name',TextType::class)
            ->add('id_category',EntityType::class,[
                'class' => Category::class,
                'choice_value' => 'id',
                'choice_label' => function($category){
                    return $category ? strtoupper($category->getName()) : '';
                },
                'choice_attr' => function($category) use ($options){
                    $selected = false;
                    if($category->getId() == $options["data"]->getIdCategory()->getId()) {
                        $selected = true;
                    }
                    return ['selected' => $selected];
                },
            ])
            ->add('id_place_expenses',EntityType::class,[
                'class' => PlaceExpenses::class,
                'choice_value' => 'id',
                'choice_label' => function($placeExpenses){
                    return $placeExpenses ? strtoupper($placeExpenses->getName()) : '';
                },
                'choice_attr' => function($placeExpenses) use ($options){
                    $selected = false;
                    if($placeExpenses->getId() == $options["data"]->getIdPlaceExpenses()) {
                        $selected = true;
                    }
                    return ['selected' => $selected];
                },
            ])
            ->add('id_wallet',EntityType::class,[
                'class' => Wallets::class,
                'choice_value' => 'id',
                'choice_label' => function($wallets){
                    return $wallets ? strtoupper($wallets->getName()) : '';
                },
                'choice_attr' => function($wallets) use ($options){
                    $selected = false;
                    if($wallets->getId() == $options["data"]->getIdWallet()) {
                        $selected = true;
                    }
                    return ['selected' => $selected];
                },
            ])
            ->add('first_date',DateType::class)
            ->add('frequency_payments',ChoiceType::class,[
                'choices' => [
                    'Jednorazowo' => 1,
                    'Codziennie'  => 2,
                    'Co tydzień'  => 3,
                    'Co dwa tygodnie'  => 4,
                    'Co miesiąc'  => 5,
                    'Co dwa miesiące'  => 6,
                    'Co kwartał'  => 7,
                    'Co pół roku'  => 8,
                    'Co rok'  => 9,
                    'Co dwa lata'  => 10,
                ]
            ])
            ->add('description',TextType::class)
            ->add('amount',MoneyType::class,[
                'currency' => 'PLN'
            ])
            ->add('active',CheckboxType::class)
            ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {

    }
}