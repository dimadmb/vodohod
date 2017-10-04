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
		//$session->start(); autostart in symfony 
		
		//$session->remove('basket');
		
		
		
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
		
		
		return ['request'=>$request, get_class_methods($session) ];
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
		
		foreach($basketS as $key => $price_id)
		{
			
			list($cruise_id,$room_id) = explode('-',$key);
			
			$basket[] = [
			'cruise' => $em->getRepository('CruiseBundle:Cruise')->findOneById($cruise_id) , 
			'room' => $em->getRepository('CruiseBundle:Room')->findOneById($room_id) , 
			'price' => $em->getRepository('CruiseBundle:Price')->findOneById($price_id) , 
			];
		}

		
		return ['request'=>$request , 'basket'=>$basket];
	}
}











