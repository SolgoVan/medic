<?php

namespace App\Form;

use App\Entity\Users;
use App\Entity\JobGrades;
use App\Form\DataTransformer\StringToDateTimeImmutableTransformer;
use DateTimeImmutable;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class UsersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
           
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => false
            ])
            ->add('lastname', TextType::class, [
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
            ->add('is_valid_account')
            ->add('created_at', DateType::class,[
                'label' => false,
                'widget' => 'single_text',
                'attr' => [
                    'class' => 'form-control'
                ],
        
            ])
            ->add('is_working')
            ->add('job_grades', EntityType::class, [
                'class' => JobGrades::class,
                'choice_label' => 'label',
                'attr' => [
                    'class' => 'form-select'
                ],
                'label' => false
            ])
           
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
