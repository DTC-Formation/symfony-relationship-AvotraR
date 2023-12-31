<?php

namespace App\Form;

use App\Entity\Etudes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

Class EtudesType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Diplomes',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Diplomes'
                    ]
                ])
                ->add('Date',DateType::class,[
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'datetime form-control',
                    ],
                ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Etudes::class,
        ]);
    }
}