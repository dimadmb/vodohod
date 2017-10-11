<?php

namespace BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ShipController extends Controller
{
	
	/**
	 * @Template()
     */		
	public function getShipsAction()
	{
		$em = $this->getDoctrine()->getManager();

		
		$query = $em->getRepository('BaseBundle:Page')->createQueryBuilder('p')
			->andWhere("p.parentUrl = 'fleet'")
			->andWhere('p.active = 1')
			->orderBy('p.name', 'ASC')
			->getQuery()
			;		
		$ships = $query->getResult();
		
		return ['ships'=>$ships];
	}	
	
}
