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

use CruiseBundle;
use CruiseBundle\Entity\Tourist;

//use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use CruiseBundle\Form\TouristType;


use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class OrderItemPlaceType extends AbstractType
{

    private $doctrine;
	private $tokenStorage;

    public function __construct( $doctrine,TokenStorageInterface $tokenStorage)
    {
        $this->doctrine = $doctrine;
		$this->tokenStorage = $tokenStorage;
    }


    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        global $kernel;
		 
        // возьмите пользователя и проведите быструю проверку на предмет его существовани
        $user = $this->tokenStorage->getToken()->getUser();
        if (!$user) {
            throw new \LogicException(
                'The FriendMessageFormType cannot be used without an authenticated user!'
            );
        }
		
		
		$em = $this->doctrine->getManager('cruise');
		
		
		
		$choices = $em->createQueryBuilder()
				->select('t')
				->from("CruiseBundle:Tourist","t")
				->leftJoin('t.touristDocuments','td')
				->where('td.userId = ' . $user->getId())
				->getQuery()
				->getResult()
			;
			
		
		$builder
			->add('tourist',EntityType::class,[
					 'class' => Tourist::class,
					// 'query_builder' => function (EntityRepository $er, $user) {
						// return $er->createQueryBuilder('t')
							// ->leftJoin('t.touristDocuments','td')
							// ->orderBy('t.id', 'DESC');
					// },
					'choices' => $choices,
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
