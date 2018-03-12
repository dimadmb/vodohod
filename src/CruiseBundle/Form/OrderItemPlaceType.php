<?php

namespace CruiseBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\ORM\EntityRepository;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

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
					'placeholder' => 'Пока не указывать туриста',
					'required' => false
			])
			
			
            ->addEventListener(
                FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData')
            )
		;
    }
	
    public function onPreSetData(FormEvent $event)
    {
        $orderItemPlace = $event->getData();
        $form = $event->getForm();
		
		
		$orderItem = $orderItemPlace->getOrderItem();
		
		$priceBaskets = $orderItem->priceBasket;
		$choices = [];
		foreach($priceBaskets as $priceBasket)
		{
			//$choices[$priceBasket['name']. " " .$priceBasket['price']] = $priceBasket['id'];
			$choices[$priceBasket['name']. " " .$priceBasket['price']] = $priceBasket['tariff'];
		}
		
		

        $form->add('tariff', ChoiceType::class, [
			'choices'  => $choices,
		]);
		
		
		//dump($form);
		
    }
			
			//->add('tourist',TouristType::class)

    
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
