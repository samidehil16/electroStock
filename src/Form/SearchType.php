<?php

namespace App\Form;

use App\Class\Search;
use App\Entity\Category;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('string',TextType::class,[
            'label'=>'Rechercher' ,
            'required'=> false,
            'attr'=>[
                'placeholder'=> 'Votre Recherche...',
                'class'=>'form-control-pcm'
            ]
         ])
        ->add('categories',EntityType::class,[
            'label'=>false,
            'required'=>false,
            'class'=>Category::class,
            'multiple'=> true,
            'expanded'=>true
        ])
        ->add('submit',SubmitType::class,[
           'label'=>'filtrer',
           'attr'=>[
               'class'=>'btn-block btn-info'
           ]
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class'=> Search::class,
            'method'=>'GET',
            'csrf_protection'=>false
        ]);
    }
    public function getBlockPrefix()
    {
        return'';
    }
}
