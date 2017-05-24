<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ShipController extends Controller
{

	/**
	 * @Template()
     */		
	public function getShipsAction()
	{
		$em = $this->getDoctrine()->getManager('cruise');

		
		$query = $em->getRepository('CruiseBundle:Motorship')->createQueryBuilder('s')
			->andWhere('s.motorshipType > 0')
			//->andWhere('s.motorshipClass > 0')
			->andWhere('s.active = 1')
			//->setParameter('price', '19.99')
			->orderBy('s.name', 'ASC')
			->getQuery()
			;		
		$ships = $query->getResult();
		
		return ['ships'=>$ships];
	}
}
