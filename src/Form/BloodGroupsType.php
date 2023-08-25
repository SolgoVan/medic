<?php

namespace App\Form;

use App\Entity\BloodGroups;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class BloodGroupsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('blood_group', ChoiceType::class,[
                'choices' => [
                    'A+' => '1',
                    'A-' => '2',
                    'B+' => '3',
                    'B-' => '4',
                    'O+' => '5',
                    'O-' => '6',
                    'AB+' => '7',
                    'AB-' => '8'
                ],
                'attr' => [
                    'class' => 'form-select'
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
            'data_class' => BloodGroups::class,
        ]);
    }
}
