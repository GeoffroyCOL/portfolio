<?php

namespace App\Form;

use App\Entity\Social;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SocialType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du réseau social',
                'label_attr' => [
                    'class'  => 'font-weight-bold'
                ]
            ])
            ->add('url', UrlType::class, [
                'label' => 'Url du réseau social',
                'label_attr' => [
                    'class'  => 'font-weight-bold'
                ]
            ])
            ->add('icon', TextType::class, [
                'label' => 'Icon du réseau social',
                'label_attr' => [
                    'class'  => 'font-weight-bold'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Social::class,
        ]);
    }
}
