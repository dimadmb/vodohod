<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session;

use CruiseBundle\Entity\Ordering;
use CruiseBundle\Entity\OrderItem;
use CruiseBundle\Entity\OrderItemPlace;
use CruiseBundle\Entity\OrderDiscount;
use CruiseBundle\Entity\Tourist;
use CruiseBundle\Entity\TouristDocument;
use CruiseBundle\Entity\Discount;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

use CruiseBundle\Form\OrderingType;
use CruiseBundle\Form\OrderDiscountType;
use CruiseBundle\Form\TouristType;

	/**
	 * @Route("/cruise")
	 */


class OrderController extends Controller
{
	
	/**
	 * @Template()
	 * @Route("/add_basket", name="cruise_add_basket" )
     */		
	public function indexAction(Request $request)
	{
		$session = new Session();
		$session->get('basket');
		if(null == $session->get('basket'))
		{
			$session->set('basket',$request->request->all());
		}
		else 
		{
			$basket = $session->get('basket');
			//$session->remove('basket');
			$basket = array_merge($basket,$request->request->all());
			$session->set('basket',$basket);
		}
		//$session->remove('basket');
		// определиться с форматом корзины в сессии 
		
		return $this->redirectToRoute('cruise_basket');
		
		return ['request'=>$request, 'session'=>$session ];
	}	
	
	
		
	/**
	 * @Route("/order", name="cruise_order" )
     */		
	public function orderAction(Request $request, $code = null)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		$session = new Session();	
		$basketS = $session->get('basket');			
		$basket = [];
		$cruises = [];
		

		if(null != $basketS)
		{

			$order = new Ordering;
			$order
				->setUser($this->getUser()->getId())
			;
			$em->persist($order);

			
			foreach($basketS as $key => $price_id)
			{
				list($cruise_id,$room_id) = explode('-',$key);
				$cruises[$cruise_id] = "";
				$cruise = $em->getRepository('CruiseBundle:Cruise')->findOneById($cruise_id);

				$room = $em->getRepository('CruiseBundle:Room')->findOneById($room_id);
				$price = $em->getRepository('CruiseBundle:Price')->findOneById($price_id);
				
				$orderItem = new OrderItem;
				$orderItem
					->setOrder($order)
					->setRoom($room)
					->setPrice($price)
					->setRoomPlace($price->getRoomPlacing())
				;
				$em->persist($orderItem);
				$order->addOrderItem($orderItem);
				for($i = 1; $i <= $price->getRoomPlacing()->getId();$i++)
				{
					$orderItemPlace = new OrderItemPlace;
					$orderItemPlace 
						->setOrderItem($orderItem)
					
					;
					$em->persist($orderItemPlace);
					$orderItem->addOrderItemPlace($orderItemPlace);
				}
				
				
			}	
			
			
			if(count($cruises) !== 1)
			{
				return $this->redirectToRoute('cruise_basket');
			}

			
			$order
				->setCruise($cruise)
			;			
			$em->flush();
			
			$session->set('basket',null);
			
			return $this->redirectToRoute('cruise_order_hash',['code'=>$order->getHashCode()]);
			
		}
		
		return $this->redirectToRoute('cruises');
		
		

	}	


	
    /**
	 * @Template()	
     * @Route("/orders", name="cruise_orders")
     */	
	public function ordersAction()
	{
		$em = $this->getDoctrine()->getManager("cruise");

		$orders = $em->getRepository("CruiseBundle:Ordering")->findByUser($this->getUser()->getId());		
		
		return ['orders'=>$orders];
	}


	
	/**
	 * @Route("/order/add_tourist", name="order_add_tourist")
	 */
	public function addTouristAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		
		$tourist = new Tourist();
		$touristDocument = new TouristDocument();
		
		//$em->persist($touristDocument);
		//$em->persist($tourist);
		
		$tourist->addTouristDocument($touristDocument);
		$touristDocument->setTourist($tourist);
		
		
		
		$form = $this->createForm(TouristType::class,$tourist,['action' => $this->generateUrl('order_add_tourist'),'attr'=>['class'=>'ajaxForm']]);
		$form->handleRequest($request);
		
		
		$response = new Response();
		$errors = [];
		
		//dump(get_class_methods($form));
		
		if($form->isSubmitted() && $form->isValid())
		{
			
			$tourist_existing = $em->getRepository("CruiseBundle:Tourist")->findOneBy([
				'name'=>$tourist->getName(),
				'lastname'=>$tourist->getLastname(),
				'fathername'=>$tourist->getFathername(),
				'dateBirth'=>$tourist->getDateBirth()
			]);
			
			if(null !== $tourist_existing)  /// тут ошибка  //написать тест для создания туриста с документом и существующего туриста с документом
			{
				//$response = new Response("",200);
				//$errors[] = "Турист уже есть в базе";
				
				
				// сделать проверку на наличие документа у этого туриста 
				
				
				foreach($tourist->getTouristDocuments() as $touristDocument)
				{
					
					// находим данные на туриста, доступные этому пользователю 
					$touristDocumentExist = $em->getRepository("CruiseBundle:TouristDocument")->findOneBy([
						'tourist' => $tourist_existing,
						'userId' => $this->getUser()->getId(),
					]);
					
					if(null !== $touristDocumentExist)
					{
						// сперва надо перенести данные, чтобы их перезаписать 
						// но надо найти лучшее решение, чтоб не зависить от полей объекта 
						$touristDocumentExist
								->setSeries($touristDocument->getSeries())
								->setNumber($touristDocument->getNumber())
								->setDate($touristDocument->getDate())
								->setPlace($touristDocument->getPlace())
								->setType($touristDocument->getType())
								->setAddress($touristDocument->getAddress())
								->setEmail($touristDocument->getEmai())
								->setPhone($touristDocument->getPhone())
						
						;
						$touristDocument = $touristDocumentExist;
					}
					
					$touristDocument->setUserId($this->getUser()->getId());
					$touristDocument->setTourist($tourist_existing);
					$em->persist($touristDocument);
					
					
					$tourist_existing->addTouristDocument($touristDocument);
					
					$em->persist($touristDocument);
					
				}
				
				$em->persist($tourist_existing);
				
				$em->flush();
				$response = new Response("",201);					
				
			}
			else
			{
				foreach($tourist->getTouristDocuments() as $touristDocument)
				{
					$touristDocument->setUserId($this->getUser()->getId());
					$em->persist($touristDocument);
					$em->persist($touristDocument);	
				}				
				$em->persist($tourist);
				$em->flush();
				$response = new Response("",201);				
			}
			

		}
		elseif($form->isSubmitted() && !$form->isValid())
		{
        return $this->render('CruiseBundle:Order:formTourist.html.twig', [
            'form' => $form->createView(), 
			'errors' => $errors,
        ]);					
		}
		// replace this example code with whatever you need
        return $this->render('CruiseBundle:Order:formTourist.html.twig', [
            'form' => $form->createView(),
            'errors' => $errors,
        ],$response);		
		
	}
	
	/**
	 * @Template()
	 * @Route("/order/{code}", name="cruise_order_hash" )
     */		
	public function orderHashAction(Request $request, $code)
	{
		
		//dump($request);
		
		$em = $this->getDoctrine()->getManager("cruise");

		$order = $em->getRepository("CruiseBundle:Ordering")->findOneByOrder1sCode($code);
		
		if(null === $order)
		{
			$order = $em->getRepository("CruiseBundle:Ordering")->findOneByHashCode($code);
		}

		if(null === $order)
		{
			return $this->redirectToRoute('cruises'); // заказ не найден 
		}
		
		$cruise = $order->getCruise();
		
		$cruise->tariffs = array_merge(
					$this->get("cruise_service")->getTariffs($cruise),
					$this->get("cruise_service")->getTariffs($cruise,true,false)
					);
		
		$turistCount = 0;
		
		foreach($order->getOrderItems() as $orderItem)
		{
			$orderItem->priceBasket = $this->get("cruise_service")->getPriceBasket($cruise, $orderItem->getRoom(), $orderItem->getPrice());
			
			$turistCount += $orderItem->getPrice()->getRoomPlacing()->getId();
			
		}		

		$data_discounts = [];
		foreach($order->getDiscounts() as $orderDiscount)
		{
			$data_discounts[] = $orderDiscount->getDiscount();
		}

		$discounts = $this->get("cruise_service")->getDiscounts($cruise,true,$turistCount);

		$form =  $this->createForm(OrderingType::class, $order)	;
		$form->add('discountAdd',EntityType::class,[
				'class' => Discount::class,
				'choice_label' => 'name',
				'multiple' => true,
				'expanded' => true,
				'mapped' => false,	
				'choices' => $discounts,
				'label' => 'Скидки',
				'attr' => ['class'=>'check_discount'],
				'choice_attr' => function($discount, $key, $index) {
					return ['exclusions' => implode(",",$discount->getExclusions()->toArray())];
				},
			])
			->get('discountAdd')->setData($data_discounts)
		; 
		$form->add('save',SubmitType::class,['label'=> 'Сохранить']);
		$form->add('send',SubmitType::class,['label'=> 'Оформить']);

		//dump($request);
		
		$form->handleRequest($request);	
		
        if ($form->isSubmitted() && $form->isValid()) 
		{	
			foreach(array_diff ($order->getDiscounts()->toArray(),$form->get('discountAdd')->getData()) as $orderDiscountRemove )
			{
				$em->remove($orderDiscountRemove);
			}
 			foreach(array_diff ($form->get('discountAdd')->getData(),$order->getDiscounts()->toArray()) as $discount )
			{
				$orderDiscount = new OrderDiscount;
				$orderDiscount->setOrder($order);
				$orderDiscount->setDiscount($discount);
				$em->persist($orderDiscount);
				$order->addDiscount($orderDiscount);
			} 
			$em->flush();
		}	
		

		if($request->isXmlHttpRequest())
		{
			return $this->render('CruiseBundle:Order:formOrder.html.twig', [
            'form' => $form->createView(),
			
        ]);
		}		
		
		$formOrderView = $this->renderView('CruiseBundle:Order:formOrder.html.twig', [
            'form' => $form->createView(),
        ]);		
		
		



		//dump($form);	
			
			

		return [
					//'allowNext'=>$allowNext,
					'discounts'=>$discounts,
					'order' => $order,
					//'turistCount' => $turistCount,
					'formOrderView' => $formOrderView,
			];
	}	

	
	/**
	 * @Template()
	 * @Route("/basket", name="cruise_basket" )
     */		
	public function basketAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		$session = new Session();
		//dump($session);
		//dump($session->getId());		
		$basketS = $session->get('basket');
		$basket = [];
		$cruises = [];
		if(null != $basketS)
		{

			foreach($basketS as $key => $price_id)
			{
				list($cruise_id,$room_id) = explode('-',$key);
				$cruises[$cruise_id] = "";
				$cruise = $em->getRepository('CruiseBundle:Cruise')->findOneById($cruise_id);
				$cruise->tariffs = array_merge(
									$this->get("cruise_service")->getTariffs($cruise),
									$this->get("cruise_service")->getTariffs($cruise,true,false)
									);
				$room = $em->getRepository('CruiseBundle:Room')->findOneById($room_id);
				$price = $em->getRepository('CruiseBundle:Price')->findOneById($price_id);
				$basket[] = [
				'cruise' =>  $cruise, 
				'room' => $room , 
				'price' => $price , 
				'priceBasket' => $this->get("cruise_service")->getPriceBasket($cruise, $room, $price),
				'places' => $price->getRoomPlacing()->getPlaces()
				];
			}		
		}
		
		$allowNext = count($cruises) == 1 ;
		$discounts = [];
		if($allowNext)
		{
			$discounts = $this->get("cruise_service")->getDiscounts($cruise,true);
			// получить количество туристов, чтоб разрешить групповую скидку
		}

		return ['request'=>$request , 'basket'=>$basket, 'allowNext'=>$allowNext, 'discounts'=>$discounts ];
	}
	
    /**
     * @Route("/basket/delete/{id}", name="basket_item_delete")
     */
    public function deleteAction(Request $request, $id)
    {
            $session = new Session();
			$basket = $session->get('basket');
			unset($basket[$id]);
			$session->set('basket',$basket);

        return $this->redirectToRoute('cruise_basket');
    }	
	
}











