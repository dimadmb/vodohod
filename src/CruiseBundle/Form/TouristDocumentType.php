<?php

namespace CruiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Validator\Constraints\Email;

class TouristDocumentType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('address', null, ['required'=>false])
			->add('email',null,[
				'required'=>false	,		   
			    'constraints' => array(
                new Email(array('checkMX' => true)),
            ),

			])
			->add('phone', null, ['required'=>false])
			->add('series', null, ['required'=>true])
			->add('number', null, ['required'=>true])
			->add('date',null,['required'=>true,'years' => range((date("Y")) , (date("Y") - 50))])
			->add('place', null, ['required'=>true])
			->add('type', null, ['required'=>true])
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CruiseBundle\Entity\TouristDocument'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cruisebundle_touristdocument';
    }


}
