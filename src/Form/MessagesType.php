<?php

namespace App\Form;

use App\Entity\Messages;
use App\Entity\Users;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessagesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Objet'
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                
            ])
            ->add('recipient', EntityType::class, [
                'class' => Users::class,
                'choice_label' => function (Users $users){
                    return $users->getFullName();
                },
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Destinataire'
            ])
            ->add('envoyer', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-secondary mt-2'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Messages::class,
        ]);
    }
}
