<?php

namespace Ocd\NewsBundle\Form;

use Ocd\NewsBundle\Entity\NewsTag;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class NewsTagType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lang', ChoiceType::class, array(
            'choices' => array(
                'Français' => 'fr',
                'English' => 'en',
            ),
            'preferred_choices' => ['fr'],
            'attr' => array('class' => 'dropdown')
        ));
        $builder->add('name', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsTag::class,
        ]);
    }
}
