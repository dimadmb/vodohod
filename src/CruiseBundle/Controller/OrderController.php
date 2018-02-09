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
		$em = $this->getDoctrine()->getManager("cruise");

		$order = $em->getRepository("CruiseBundle:Ordering")->findOneByHashCode($code);
		
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
		
		$allowNext = true ;
		$discounts = [];

		$discounts = $this->get("cruise_service")->getDiscounts($cruise,true,$turistCount);
			// получить количество туристов, чтоб разрешить групповую скидку

		return ['allowNext'=>$allowNext, 'discounts'=>$discounts, 'order' => $order, 'turistCount' => $turistCount ];
	}	
	
	
	
	/**
	 * @Template()
	 * @Route("/basket", name="cruise_basket" )
     */		
	public function basketAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		$session = new Session();
		dump($session);
		dump($session->getId());		
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











