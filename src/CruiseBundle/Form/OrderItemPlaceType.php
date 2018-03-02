<?php

namespace CruiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use CruiseBundle\Entity\Tourist;

//use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use CruiseBundle\Form\TouristType;

class OrderItemPlaceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('tourist',EntityType::class,[
					 'class' => Tourist::class,
					'query_builder' => function (EntityRepository $er) {
						return $er->createQueryBuilder('t')
							->orderBy('t.id', 'DESC');
					},
					//'choice_label' => 'name',
					//'placeholder' => 'Новый турист',
					//'required' => false
			])
			//->add('tourist',TouristType::class)
		;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CruiseBundle\Entity\OrderItemPlace'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'cruisebundle_orderitemplace';
    }


}
