<?php

namespace CruiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\HiddenType;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class TouristType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
		//->add('id'/*,HiddenType::class*/)
		->add('lastname')
		->add('name')
		->add('fathername')
		->add('dateBirth',null,['years' => range((date("Y")) , (date("Y") - 100))])
		->add('address')
		->add('email')
		->add('phone')

		//->add('touristDocuments')
		
		->add('submit', SubmitType::class)	
		
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CruiseBundle\Entity\Tourist'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cruisebundle_tourist';
    }


}
