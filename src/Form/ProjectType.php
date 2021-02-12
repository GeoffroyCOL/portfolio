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
                'label' => 'Le nom du projet'
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Contenue du projet',
                'attr' => [
                    'rows'  => 10
                ]
            ])
            ->add('createdAt', DateType::class, [
                'label'     => 'Date de création',
                'widget'    => 'single_text',
            ])
            ->add('website', UrlType::class, [
                'label'     => 'Lien du projet',
                'required'  => false
            ])
            ->add('github', UrlType::class, [
                'label'     => 'Lien du repositorie',
                'required'  => false
            ])
            ->add('category', EntityType::class, [
                'class'         => Category::class,
                'choice_label'  => 'name',
                'multiple'      => true,
            ])
            ->add('featured', ImageType::class, [
                'label' => 'image mise en avant'
            ])
            ->add('Submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Project::class,
        ]);
    }
}
