<?php

namespace App\Form;

use App\Entity\Project;
use App\Form\ImageType;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Le nom du projet',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('createdAt', DateType::class, [
                'label'     => 'Date de création',
                'widget'    => 'single_text',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('website', UrlType::class, [
                'label'     => 'Lien du projet',
                'required'  => false,
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('github', UrlType::class, [
                'label'     => 'Lien du repositorie',
                'required'  => false,
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenue du projet',
                'attr' => [
                    'rows'  => 10
                ],
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('category', EntityType::class, [
                'label'         => 'Categorie',
                'class'         => Category::class,
                'choice_label'  => 'name',
                'multiple'      => true,
                'attr'  => [
                    'class' => 'js-select-multiple'
                ],
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('featured', ImageType::class, [
                'label' => 'Image mise en avant',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
