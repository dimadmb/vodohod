<?php

namespace BaseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Ivory\CKEditorBundle\Form\Type\CKEditorType;

use Symfony\Component\Form\Extension\Core\Type\FileType;

class PageType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('localUrl')
            ->add('title')
            ->add('h1')
            ->add('bannerHtml')
            ->add('bannerImg',FileType::class, ['data_class' => null,'required'=>false])
            ->add('body', CKEditorType::class)
            ->add('sort')
            ->add('active')
            ->add('isMenu')
            ->add('isFolder')
            ->add('parent')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BaseBundle\Entity\Page'
        ));
    }
}
