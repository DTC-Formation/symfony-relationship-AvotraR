<?php
namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

Class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('Lot',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Lot'
                    ]
                ])
                ->add('ville',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control',
                        'placeholder'=>'Ville'
                    ]
                ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
