<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\HttpFoundation\Session\Session;

class OrderController extends Controller
{
	
	/**
	 * @Template()
	 * @Route("/cruise/order", name="cruise_order" )
     */		
	public function indexAction(Request $request)
	{
		
		$session = new Session();
		//$session->start(); //autostart in symfony 
		
		//$session->remove('basket');
		
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
		
		
		return ['request'=>$request ];
	}	
	
	
	
	/**
	 * @Template()
	 * @Route("/cruise/basket", name="cruise_basket" )
     */		
	public function basketAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		
		
		$session = new Session();
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
									$this->get("cruise_service")->getTariffs($cruise,true,false),
									$this->get("cruise_service")->getTariffs($cruise)
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
			$discounts = $this->get("cruise_service")->getDiscounts($cruise);
			
			// получить количество туристов, чтоб разрешить групповую скидку
			
		}

		return ['request'=>$request , 'basket'=>$basket, 'allowNext'=>$allowNext, 'discounts'=>$discounts ];
	}
	
    /**
     * @Route("/cruise/basket/delete/{id}", name="basket_item_delete")
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











