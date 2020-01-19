<?php

namespace Ocd\NewsBundle\Form;

use Ocd\NewsBundle\Entity\NewsAttachment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichFileType;

class NewsAttachmentType extends AbstractType
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
        $builder->add('attachmentFile', VichFileType::class, [
            'required' => false,
            'allow_delete' => true, 
            'download_uri' => true,
            'download_label' => 'download_file',
            'asset_helper' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => NewsAttachment::class,
        ]);
    }
}
