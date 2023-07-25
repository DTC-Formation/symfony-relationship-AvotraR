<?php
namespace App\Form;

use App\Entity\User;
use App\Entity\Adresse;
use App\Form\AdresseType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class UserType extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('Nom',TextType::class,[
            'attr'=>[
                "class"=>"nom-input",
                "placeholder" => "Nom"
            ]
        ])
        ->add('Prenom',TextType::class,[
            'attr'=>[
                "class"=>"nom",
                "placeholder" => "Prenom"
            ]
        ])
        ->add('Age',NumberType::class,[
            'attr'=>[
                "class"=>"age-input",
                "placeholder" => "Age"
            ]
            ])
        ->add('Adresse',AdresseType::class)
        ->add('Contact',CollectionType::class,[
            'entry_type'=>ContactType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'label'=>false,
            'by_reference' => false,
        ])
        ->add('Etudes',CollectionType::class,[
            'entry_type'=>EtudesType::class,
            'allow_add' => true,
            'allow_delete' => true,
            'label'=>false,
            'by_reference' => false,
        ]);
        
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
