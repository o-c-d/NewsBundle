<?php

namespace Ocd\NewsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Ocd\NewsBundle\Entity\News;
use Ocd\NewsBundle\Entity\NewsTag;
use Ocd\NewsBundle\Form\NewsTagType;
use Vich\UploaderBundle\Form\Type\VichImageType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;

class NewsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
        $builder->add('slug', TextType::class, array('attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
        $builder->add('description', TextType::class, array('required' => false, 'attr' => array('class' => 'form-control', 'style' => 'margin-bottom:15px')));
        $builder->add('content', CKEditorType::class, array(
            'config_name' => 'my_config',
        ));
        $builder->add('lang', ChoiceType::class, array(
            'choices' => array(
                'Français' => 'fr',
                'English' => 'en',
            ),
            'preferred_choices' => ['fr'],
            'attr' => array('class' => 'dropdown')
        ));
        $builder->add('publishedAt', DateTimeType::class, array(
            'attr' => array(
                'class' => 'form-control input-inline js-datetimepicker',
                'style' => 'margin-bottom:15px',
                'data-toggle' => "datetimepicker",
                'data-target' => "#news_publishedAt",
            ),
            'widget' => 'single_text',
            'html5' => false,
            'format' => 'dd-MM-yyyy HH:mm',
            'required' => false,
        ));
        if(in_array('ROLE_SUPER_ADMIN', $options['roles'])) {
            $builder->add('updatedAt', DateTimeType::class, array(
                'attr' => array(
                    'class' => 'form-control input-inline js-datetimepicker',
                    'style' => 'margin-bottom:15px',
                    'data-toggle' => "datetimepicker",
                    'data-target' => "#news_updatedAt",
                ),
                'widget' => 'single_text',
                'html5' => false,
            'format' => 'dd-MM-yyyy HH:mm',
            ));
            $builder->add('createdAt', DateTimeType::class, array(
                'attr' => array(
                    'class' => 'form-control input-inline js-datetimepicker',
                    'style' => 'margin-bottom:15px',
                    'data-toggle' => "datetimepicker",
                    'data-target' => "#news_createdAt",
                ),
                'widget' => 'single_text',
                'html5' => false,
            'format' => 'dd-MM-yyyy HH:mm',
            ));
        }
        $builder->add('backgroundFile', VichImageType::class, [
            'required' => false,
            'allow_delete' => true,
            'download_label' => 'download_file',
            'download_uri' => true,
            'image_uri' => true,
            'imagine_pattern' => null,
            'asset_helper' => true,
        ]);
         
        $builder->add('tags', CollectionType::class, [
            'entry_type' => NewsTagType::class,
            'entry_options' => ['label' => false],
            'allow_add' => true,
            'by_reference' => false,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => News::class,
            'roles' => ['ROLE_USER']
        ));
    }
}
