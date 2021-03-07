<?php
namespace App\Form\Type;

use App\Entity\Expenses;
use App\Entity\Category;
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

class EditExpensesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options) : void
    {
        $builder
            ->add('id_category',EntityType::class,[
                'class' => Category::class,
                'choice_value' => 'id',
                'choice_label' => function($category){
                    if($category->getIdUser() == $this->getUser()){
                        return $category ? strtoupper($category->getName()) : '';
                    }else{
                        return '';
                    }
                },
                'choice_attr' => function($category) use ($options){
                    $selected = false;
                    if($category->getId() == $options["data"]->getIdCategory()) {
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
            ->add('date',DateType::class)
            ->add('description',TextType::class)
            ->add('amount',MoneyType::class)
            ->add('save',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Expenses::class,
            'csrf_protection' => false,
        ]);
    }
}
?>
