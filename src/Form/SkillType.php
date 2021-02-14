<?php

namespace App\Form;

use App\Entity\Skill;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SkillType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la compétence',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('color', ColorType::class, [
                'label' => 'Couleur de la compétence',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('icon', TextType::class, [
                'label' => 'Icon de la compétence',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
            ->add('level', ChoiceType::class, [
                'required' => true,
                'multiple' => false,
                'expanded' => false,
                'choices'  => $this->getChoices(),
                'label' => 'Niveau',
                'label_attr' => [
                    'class' => 'font-weight-bold'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Skill::class,
        ]);
    }
    
    /**
     * getChoices
     *
     * @return array
     */
    private function getChoices(): array
    {
        $choices = Skill::LEVEL;
        $output = [];
        foreach ($choices as $value) {
            $output[$value] = $value;
        }

        return $output;
    }
}
