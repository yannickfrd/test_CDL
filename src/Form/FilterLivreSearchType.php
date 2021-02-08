<?php

namespace App\Form;

use App\Entity\Auteur;
use App\Entity\Categorie;
use App\Entity\FilterLivre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterLivreSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $now = new \DateTime('now');
        $ans = [];
        for ($i=1900; $i<=$now->format('Y');$i++){
            $ans[] += $i;
        }

        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom du livre',
                ],
                'required' => false,
                'label' => 'Nom du livre'
            ])
            ->add('date', ChoiceType::class, [
                'choices' => $ans,
                'choice_label' => function($an, $key, $value) {
                    return strtoupper($value);
                },
                'required' => false,
                'label' => 'Date du livre'
            ])
            ->add('auteur', EntityType::class, [
                'class' => Auteur::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Nom de l\'auteur'
            ])
            ->add('categorie', EntityType::class, [
                'multiple' => true,
                'expanded' => true,
                'class' => Categorie::class,
                'choice_label' => 'name',
                'required' => false,
                'label' => 'Nom de la categorie'
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Rechercher'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => FilterLivre::class,
            'method' => 'get',
            'csrf-protection' => false
        ]);
    }
}
