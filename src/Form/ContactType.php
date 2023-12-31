<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

Class ContactType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Tel',TelType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Telephone'
                    ]
                ])
                ->add('mail',EmailType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Mail'
                    ]
                ])
                ->add('linkdin',EmailType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Linkdin'
                    ]
                ]);
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}