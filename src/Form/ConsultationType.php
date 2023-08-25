<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\Examens;
use App\Entity\Consultations;
use App\Entity\Localisations;
use App\Entity\EmergencyVehicles;
use App\Entity\PatientIdentities;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('care', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '10'
                ],
                'label' => false
            ])
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('emergency', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('comment', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'rows' => '5'
                ],
                'label' => false
            ])
            ->add('practitioner', EntityType::class, [
                'class' => Users::class,
                'choice_label' => function (Users $users){
                    return $users->getFullName();
                },
                'placeholder' => '-- Selectionner un medecin --',
                'attr' => [
                    'class' => 'form-select',
                ],
                'label' => false
            ])
            ->add('patients_identities', EntityType::class, [
                'class' => PatientIdentities::class,
                'choice_label' => function (PatientIdentities $patientIdentities){
                    return $patientIdentities->getFullName();
                },
                'placeholder' => '-- Selectionner un patient --',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
            ->add('examen', EntityType::class, [
                'class' => Examens::class,
                'choice_label' => 'label',
                'placeholder' => '-- Selectionner un type de consultation --',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
            ->add('localisation', EntityType::class,[
                'class' => Localisations::class,
                'choice_label' => 'localisation',
                'placeholder' => '-- Selectionner la localisation --',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
            ->add('vehicle', EntityType::class,[
                'class' => EmergencyVehicles::class,
                'choice_label' => 'label',
                'placeholder' => '-- Selectionner un véhicule d\'intervention --',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
            ->add('Continuer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-success btn-lg mt-2'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Consultations::class,
        ]);
    }
}
