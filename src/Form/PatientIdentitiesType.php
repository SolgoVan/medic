<?php

namespace App\Form;

use App\Entity\Genres;
use App\Entity\PatientIdentities;
use App\Form\DataTransformer\GenderTransformer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientIdentitiesType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('firstname', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false 
            ])
            ->add('email', EmailType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('phone', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('birth_date', DateType::class,[
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('genre', EntityType::class, [
                'class' => Genres::class,
                'choice_label' => 'genre',
                'placeholder' => 'Slectionner un genre',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
            ->add('occupation', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Si aucune profession, inscrire "aucun".'
                ],
                'label' => false
            ])
            ->add('employer', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Si aucun employeur, inscrire "aucun".'
                ],
                'label' => false
            ])
            
            /*->add('Continuer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success btn-lg'
                ]
            ])*/
        ;

    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PatientIdentities::class,
        ]);
    }

   
}

/*->add('genders', ChoiceType::class,[
    'choices' => $this->getGenderChoices(),
    'choice_value' => 'id',
    'attr' => [
        'class' => 'form-select'
    ],
    'label' => false
])*/