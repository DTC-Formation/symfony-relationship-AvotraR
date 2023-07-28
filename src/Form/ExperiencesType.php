<?php
namespace App\Form;

use App\Entity\Experiences;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

Class ExperiencesType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('DateDebut',DateType::class,[
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'datetime form-control',
                    ],
                ])
                ->add('DateFin',DateType::class,[
                    'widget' => 'single_text',
                    'attr' => [
                        'class' => 'datetime form-control',
                    ],
                ])
                ->add('Titre',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Titre'
                    ]
                ]);    
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experiences::class,
        ]);
    }
}