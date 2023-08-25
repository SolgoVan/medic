<?php

namespace App\Form;


use App\Entity\Patients;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('patientsIdentities')
            ->add('blood_group')
            ->add('measurement')
            ->add('addiction')
            ->add('pathology')
            ->add('emergency_person')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Patients::class,
        ]);
    }
}
