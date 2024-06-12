<?php

namespace App\Form;

use App\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class OperationType extends AbstractType
{
    //Fonction de construction de formulaire, créer automatiquement par symfony
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        // Les champs de notre formulaire
        //dd($options);
        $builder
            ->add('a', NumberType::class,
            [
                "label"     => "Entrer la valeur de a : ",
                "scale"     => 3,
                "html5"     => true
                ])
            ->add('b', NumberType::class,
            [
                "label"     => "Entrer la valeur de b : ",
                "scale"     => 3,
                "html5"     => true,
                ])
            ->add('submit', SubmitType::class, [
                'label' => 'Calculer'
            ]);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Operation::class, //Definir la l'entité(table) associer à cet formulaire
            //'required' => true
        ]);
    }
}