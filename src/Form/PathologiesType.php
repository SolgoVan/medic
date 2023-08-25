<?php

namespace App\Form;

use App\Entity\Pathologies;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class PathologiesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('is_allergic', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('allergy', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_diabetic', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('diabetes', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_asmatic', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('asthma', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_cardiac', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('cardiac', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_epileptic', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('epilepsy', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_historic', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('antecedent', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('is_treatement', CheckboxType::class,[
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('treatement', TextType::class,[
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false,
                'required' => false
            ])
            ->add('comment', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'cols' => '40',
                    'rows' => '2'
                ],
                'label' => false,
                'required' => false
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
            'data_class' => Pathologies::class,
        ]);
    }
}
