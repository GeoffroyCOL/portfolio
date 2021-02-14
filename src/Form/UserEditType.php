<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('newPassword', RepeatedType::class, [
                'label' => 'Mot de passe',
                'type' => PasswordType::class,
                'invalid_message' => 'Les mots de passes ne correspondent pas.',
                'options' => [
                    'attr' => ['class' => 'font-weight-bold mb-3'],
                    'label_attr' => ['class'  => 'font-weight-bold']
                ],
                'required' => false,
                'first_options'  => ['label' => 'Choisir un mot de passe'],
                'second_options' => ['label' => 'Répéter votre mot de passe'],
                'label_attr' => [
                    'class'  => 'font-weight-bold mb-2',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Adresse email',
                'required' => true,
                'label_attr' => [
                    'class'  => 'font-weight-bold mb-2',
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Votre description',
                'required' => true,
                'attr' => [
                    'rows'  => 8
                ],
                'label_attr' => [
                    'class'  => 'font-weight-bold mb-2',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
