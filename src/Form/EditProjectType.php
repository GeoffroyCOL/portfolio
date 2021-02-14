<?php

namespace App\Form;

use App\Entity\Project;
use App\Form\ImageType;
use App\Form\ProjectType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditProjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('featured', ImageType::class, [
                'label'     => 'Image mise en avant',
                'required'  => false,
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
    
    /**
     * @return string
     */
    public function getParent(): string
    {
        return ProjectType::class;
    }
}
