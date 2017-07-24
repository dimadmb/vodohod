<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class ShipController extends Controller
{

	/**
	 * @Route("/fleet/{shipcode}", name="fleet_ship" )	
	 * @Template()
     */		
	public function shipAction($shipcode)
	{
		$em = $this->getDoctrine()->getManager('cruise');

		
		$query = $em->getRepository('CruiseBundle:Motorship')->createQueryBuilder('s')
			->select('s,smr,sh')
			->leftJoin('s.motorshipRooms', 'smr')
			->leftJoin('s.hall', 'sh')
			->addOrderBy('sh.priority','ASC')
			->andWhere("s.code = '".$shipcode."'")
			->getQuery()
			;		
		$ship = $query->getOneOrNullResult();
		if ($ship == null) {
			throw $this->createNotFoundException("Страница не найдена.");
		}

		$page = $this->getDoctrine()->getRepository('BaseBundle:Page')->findOneByFullUrl("fleet/".$shipcode);
		
		$ship->setProperties(explode(PHP_EOL,$ship->getProperties()));
		$ship->setDescription(explode(PHP_EOL,$ship->getDescription()));
		
		$parameters = [];
		$parameters['page'] = $page;
		$parameters['ship'] = $ship;
		if("" != $page->getBannerImg())
		{
			$parameters['bannerImg'] = $page->getBannerImg();
		}
		if("" != $page->getBannerHtml())
		{
			//$parameters['bannerHtml'] = $page->getBannerHtml(); // этот текст можно автоматизировать !!!
			$parameters['bannerHtml'] = $this->renderView("CruiseBundle:Ship:shiph1.html.twig",['ship'=>$ship]);
		}
		
		
		return $parameters;		
	}
	
	/**
	 * @Route("/fleet", name="fleet" )	
	 * @Template()
     */		
	public function indexAction()
	{
		$em = $this->getDoctrine()->getManager('cruise');

		
		$query = $em->getRepository('CruiseBundle:Motorship')->createQueryBuilder('s')
			

			
			->andWhere('s.motorshipType > 0')
			->andWhere('s.active = 1') 
			->orderBy('s.name', 'ASC')
			->getQuery()
			;		
		$ships = $query->getResult();
		
		$page = $this->getDoctrine()->getRepository('BaseBundle:Page')->findOneByFullUrl("fleet");
		
		$parameters = [];
		$parameters['page'] = $page;
		$parameters['ships'] = $ships;
		if("" != $page->getBannerImg())
		{
			$parameters['bannerImg'] = $page->getBannerImg();
		}
		if("" != $page->getBannerHtml())
		{
			$parameters['bannerHtml'] = $page->getBannerHtml();
		}
		
		
		return $parameters;		
	}
	
	
	/**
	 * @Template()
     */		
	public function getShipsAction()
	{
		$em = $this->getDoctrine()->getManager('cruise');

		
		$query = $em->getRepository('CruiseBundle:Motorship')->createQueryBuilder('s')
			->andWhere('s.motorshipType > 0')
			->andWhere('s.active = 1')
			->orderBy('s.name', 'ASC')
			->getQuery()
			;		
		$ships = $query->getResult();
		
		return ['ships'=>$ships];
	}
}
