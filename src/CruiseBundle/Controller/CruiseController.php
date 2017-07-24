<?php

namespace CruiseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use CruiseBundle\Entity\Cruise;

use Doctrine\ORM\EntityRepository;

use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


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
		
		
		
		
		$form = $this->get('form.factory')->createNamedBuilder(null,FormType::class,null, ['csrf_protection' => false,'validation_groups' => false])
		
				->add('motorship',EntityType::class, [
				'multiple' => true,
				'required' => false,
				'placeholder' => 'Choose an option',
				'class' => 'CruiseBundle:Motorship',
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('m')
						->where('m.motorshipType > 0')
						->andWhere('m.active = 1')
						->orderBy('m.name', 'ASC');
				},
				'choice_label' => 'name',				
				] )
				
				->add('class',EntityType::class, [
				'multiple' => true,
				'required' => false,
				'placeholder' => 'Choose an option',
				'class' => 'CruiseBundle:MotorshipClass',
				'query_builder' => function (EntityRepository $er) {
					return $er->createQueryBuilder('mc')
						->orderBy('mc.priority', 'ASC');
				},
				'choice_label' => 'name',				
				] )
				
				
				->add('days',ChoiceType::class, [
						'placeholder' => 'все',
						'required' => false,
						'choices'  => [
							'1-4' => '1-4',
							'5-7' => '5-7',
							'8-10' =>'8-10',
							'11-14' => '11-14',
							'15-23' => '15-23'
						],])
				
				->add('sortable',ChoiceType::class, [
						'choices'  => [
							'По дате (по возрастанию)' => '1',
							'По дате (по убыванию)' => '2',
							'По цене (дешевле - дороже)' =>'3',
							'По цене (дороже - дешевле)' => '4',
						],])	
				
				->add('submit', SubmitType::class,array('attr'=>[ 'class'=> 'btn btn-red full-width']))
				->setMethod('GET')
				->getForm()
			;

			
		$form->handleRequest($request);	
		

		$em = $this->getDoctrine()->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');
		//$cruises = $cruiseRepository->findAll();
		//$cruises = $cruiseRepository->findBy(["archives"=>0],["dateStart"=>"ASC"],5);
		$qb = $em->createQueryBuilder();
		 $qb
		->select('c,m')
        ->from('CruiseBundle:Cruise','c')
		->leftJoin('c.motorship', 'm')
		
        ->where('c.motorship IS NOT NULL')
		
		->andWhere('c.archives = 0')
		->andWhere('c.forSale = 1')
		->andWhere('c.dateStop > CURRENT_DATE()')
		;
		
		$qb->setMaxResults($countInPage);
		$qb->setFirstResult($countInPage*$firstResult);		
		
		if ($form->isSubmitted() /*&& $form->isValid()*/) 
		{
			$data = $form->getData();
			// теплоходы
			if(count($data['motorship']) > 0)
			{
				$in = [];
				foreach($data['motorship'] as $motorship)
				{	$in[] = $motorship->getId();	}
				$qb->andWhere('c.motorship in ('.implode(",",$in).')');
			}
			// класс теплохода
			if(count($data['class']) > 0)
			{
				$in = [];
				foreach($data['class'] as $class)
				{	$in[] = $class->getId();	}
				$qb->andWhere('m.motorshipClass in ('.implode(",",$in).')');
			}
			// дней в круизе
			if(null != $data['days'])
			{
				$days = $data['days'];
				list($dmin,$dmax) = explode("-",$days);
				$qb->andWhere("DATE_DIFF(c.dateStop ,c.dateStart )  >= $dmin - 1 ");
				$qb->andWhere("DATE_DIFF(c.dateStop ,c.dateStart )  <= $dmax - 1 ");
			}
			
			if(isset($data['sortable']) && null != $data['sortable'])
			{
				if($data['sortable'] == '1')
				{
					$qb->orderBy('c.dateStart','ASC');
				}
				if($data['sortable'] == '2')
				{
					$qb->orderBy('c.dateStart','DESC');
				}
				if($data['sortable'] == '3')
				{
					$qb->orderBy('c.dateStart','ASC');
					
					// сделать сортировку по цене
					
				}
				if($data['sortable'] == '4')
				{
					$qb->orderBy('c.dateStart','ASC');
					
					// сделать сортировку по цене
					
				}
			}
			else
			{
				$qb->orderBy('c.dateStart','ASC');
			}
		}			

		    $paginator  = $this->get('knp_paginator');
			$cruises = $paginator->paginate(
				$qb, 
				$request->query->getInt('page', 1)/*page number*/,
				$countInPage 
			);

		
		if(null != $request->query->get('ajax')) return new Response(count($cruises));
				
		$cruiseRoomStatusRepository = $em->getRepository('CruiseBundle:CruiseRoomStatus');
		foreach($cruises as $cruise)
		{

			if(false !==  $countFreeRoom = $this->get('memcache.default')->get('countFreeRoom'.$cruise->getId()) )
			{$cruise->freeCountRoom = $countFreeRoom;}
			else
			{
				$cruise->freeCountRoom = $cruiseRoomStatusRepository->countFreeRoom($cruise->getId());
				$this->get('memcache.default')->set('countFreeRoom'.$cruise->getId(),$cruise->freeCountRoom,0,60*60*1);  // час 
			}
			
			$days = 1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
			$cruise->days = $days;			
		}
		
		
		
		
		return ["cruises" => $cruises, "form"=> $form->createView()];
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

