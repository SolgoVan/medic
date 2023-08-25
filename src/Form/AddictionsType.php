<?php

namespace App\Form;

use App\Entity\Addictions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddictionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tobacco', ChoiceType::class,[
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false,
                'choices' => [
                    'Jamais' => 'Jamais',
                    'Occasionnel' => 'Occasionnel',
                    'Souvent' => 'Souvent',
                    'Addict' => 'Addict'
                ]
            ])
            ->add('alcohol' , ChoiceType::class,[
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false,
                'choices' => [
                    'Jamais' => 'Jamais',
                    'Occasionnel' => 'Occasionnel',
                    'Souvent' => 'Souvent',
                    'Addict' => 'Addict'
                ]
            ])
            ->add('drug' , ChoiceType::class,[
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false,
                'choices' => [
                    'Jamais' => 'Jamais',
                    'Occasionnel' => 'Occasionnel',
                    'Souvent' => 'Souvent',
                    'Addict' => 'Addict'
                ]
            ])
            ->add('other', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('Continuer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success btn-lg'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Addictions::class,
        ]);
    }
}
