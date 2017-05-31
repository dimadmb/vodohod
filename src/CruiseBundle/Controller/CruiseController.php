<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Symfony\Component\HttpFoundation\Request;


use Symfony\Component\HttpFoundation\Response;

class CruiseController extends Controller
{
	public function testAction($name = "")
	{
		return new Response("OKKKK ".$name);
	}
	
	
	/**
	 * @Template()
     */		
	public function nearestCruisesAction($count = 5)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');
		//$cruises = $cruiseRepository->findAll();
		//$cruises = $cruiseRepository->findBy(["archives"=>0],["dateStart"=>"ASC"],5);
		$qb = $em->createQueryBuilder();
		$cruises = $qb
		->select('c')
        ->from('CruiseBundle:Cruise','c')
		//->leftJoin('c.motorship', 'm')
		
		//->leftJoin('c.cruiseDays','ccd')
		//->leftJoin('ccd.port','port')
		
        ->where('c.motorship IS NOT NULL')
		->andWhere('c.archives = 0')
		->andWhere('c.forSale = 1')
		->andWhere('c.dateStart > CURRENT_DATE()')
		//->andWhere("m.name like '%бел%'")
		->setMaxResults($count)
		->orderBy('c.dateStart','ASC')
        ->getQuery()
        ->getResult();
		;	
		
		
		foreach($cruises as $cruise)
		{
			$days = 1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
			$cruise->days = $days;
		}
		

		return ["cruises" => $cruises];
		
	}


	
	/**
	 * @Template()
	 * @Route("/cruises", name="cruises" )
     */		
	public function cruisesAction(Request $request)
	{
		$countInPage = 25;
		$countInPage = $request->query->get('in_p') != null ? (int)$request->query->get('in_p') : $countInPage ;
		$firstResult = $request->query->get('p') != null ? (int)$request->query->get('p') : 0;
		
		
		$em = $this->getDoctrine()->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');
		//$cruises = $cruiseRepository->findAll();
		//$cruises = $cruiseRepository->findBy(["archives"=>0],["dateStart"=>"ASC"],5);
		$qb = $em->createQueryBuilder();
		$cruises = $qb
		->select('c,m')
        ->from('CruiseBundle:Cruise','c')
		->leftJoin('c.motorship', 'm')
        ->where('c.motorship IS NOT NULL')
		->andWhere('c.archives = 0')
		->andWhere('c.forSale = 1')
		->andWhere('c.dateStop > CURRENT_DATE()')
		//->andWhere("m.name like '%бел%'")
		->setMaxResults($countInPage)
		->setFirstResult($countInPage*$firstResult)
		->orderBy('c.dateStart','ASC')
        ->getQuery()
        ->getResult();
		;
				
		$cruiseRoomStatusRepository = $em->getRepository('CruiseBundle:CruiseRoomStatus');
		foreach($cruises as $cruise)
		{

			if(false !==  $countFreeRoom = $this->get('memcache.default')->get('countFreeRoom'.$cruise->getId()) )
			{$cruise->freeCountRoom = $countFreeRoom;}
			else
			{
				$cruise->freeCountRoom = $cruiseRoomStatusRepository->countFreeRoom($cruise->getId());
				$this->get('memcache.default')->set('countFreeRoom'.$cruise->getId(),$cruise->freeCountRoom,0,60*10*1);
			}
			
			$days = 1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
			$cruise->days = $days;			
		}
		return ["cruises" => $cruises];
	}
	
	
	/**
	 * @Template()
	 * @Route("/cruises/{id}", name="cruise_detail" )
     */		
	public function cruisedetailAction($id)
	{
		$em = $this->getDoctrine()->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');

		$cruiseRoomStatusRepository = $em->getRepository('CruiseBundle:CruiseRoomStatus');
		$freeRooms = $cruiseRoomStatusRepository->getFreeRooms($id)	;	
		
		$q = "
			SELECT c,m,r
			FROM CruiseBundle:Cruise c
			LEFT JOIN c.motorship m
			LEFT JOIN m.room r
			WHERE c.motorship IS NOT NULL
			AND c.archives = 0
			AND c.id = :id

		";
		/// добавить в селект выборку по свободной каюте
		
		// каюты можно грузить отдельно, чтоб не напрягать память дублями круиза и теплохода
		
		$query = $em->createQuery($q);
		$query->setParameter('id', $id);
		
		$cruise = $query->getOneOrNullResult();
		
		//$cruise->freeCountRoom = $cruiseRoomStatusRepository->countFreeRoom($cruise->getId()); 
		
		foreach($freeRooms as $room)
		{
			$freeRoomsArray[$room["room_id"]] = $room["final_reserve"];
		}
		
		foreach($cruise->getMotorship()->getRoom() as $room)
		{
			$room->setStatus(  isset($freeRoomsArray[$room->getId()]) ? $freeRoomsArray[$room->getId()] : 1   );
			
			// разбить каюты по палубам и по типам (скорее по ценам )
		}
		
		/// вывести список кают на круиз
		$rooms = [];
		
		
		return ["cruise" => $cruise, "rooms" => $rooms];
	}
}

