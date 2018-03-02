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
use CruiseBundle\Entity\Tourist;


use CruiseBundle\Form\OrderingType;
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
	 * @Template()
	 * @Route("/order/{code}", name="cruise_order_hash" )
     */		
	public function orderHashAction(Request $request, $code)
	{
		
		dump($request);
		
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
		

		
		
		$form =  $this->createForm(OrderingType::class, $order)	;
		
		$form->handleRequest($request);

		foreach($order->getOrderItems() as $orderItem)
		{
			$orderItem->priceBasket = $this->get("cruise_service")->getPriceBasket($cruise, $orderItem->getRoom(), $orderItem->getPrice());
			
			$turistCount += $orderItem->getPrice()->getRoomPlacing()->getId();
			
			foreach($orderItem->getOrderItemPlaces() as $orderItemPlace )
			{
				if(null === $orderItemPlace->getTourist())
				{
					$tourist = new \CruiseBundle\Entity\Tourist;
					$em->persist($tourist);
					$orderItemPlace->setTourist($tourist);	
				}

			}
			
		}		
		

        if ($form->isSubmitted() && $form->isValid()) 
		{	
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
		
		
		$allowNext = true ;
		$discounts = [];

		$discounts = $this->get("cruise_service")->getDiscounts($cruise,true,$turistCount);
			// получить количество туристов, чтоб разрешить групповую скидку

		return [
					'allowNext'=>$allowNext,
					'discounts'=>$discounts,
					'order' => $order,
					'turistCount' => $turistCount,
					'formOrderView' => $formOrderView,
			];
	}	
	
	/**
	 * @Route("/cruise/order/add_tourist", name="order_add_tourist")
	 */
	public function addTouristAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		
		$tourist = new Tourist();
		
		$form = $this->createForm(TouristType::class,$tourist,['action' => $this->generateUrl('order_add_tourist'),'attr'=>['class'=>'ajaxForm']]);
		$form->handleRequest($request);
		
		if($form->isSubmitted() && $form->isValid())
		{
			$em->persist($tourist);
			$em->flush();
		}
		// replace this example code with whatever you need
        return $this->render('CruiseBundle:Order:formTourist.html.twig', [
            'form' => $form->createView(),
        ]);		
		
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











