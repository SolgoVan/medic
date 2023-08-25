<?php

namespace App\Form;

use App\Entity\Measurements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MeasurementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('size', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'En cm'
                ],
                'label' => false
            ])
            ->add('weight', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'En kg'
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
            'data_class' => Measurements::class,
        ]);
    }
}
