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

	/**
	 * @Route("/cruisestest", name="cruisestest" )
     */		
	public function testAction()
	{
		
		
		$em_c=$this->getDoctrine()->getManager('cruise');
		$dump = $em_c->getRepository("CruiseBundle:Cruise")->findAll();
		
		return $this->render('dump.html.twig',['dump'=>$dump]);
		
		return new Response("OKKKK ");
	}
	
	
	/**
	 * @Template()
     */		
	public function nearestCruisesAction($count = 5)
	{
		$cruises = $this->get("cruise_service")->searchAction(['dateStart'=> new \DateTime()],$count,1);
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
				->add('months',ChoiceType::class, [
						'placeholder' => 'Любой',
						'required' => false,
						'choices'  => $this->get("cruise_service")->getMonths(),])				
				
				->add('days',ChoiceType::class, [
						'placeholder' => 'все',
						'required' => false,
						'choices'  => [
							'1-4' => '1-4',
							'5-7' => '5-7',
							'8-10' =>'8-10',
							'11-14' => '11-14',
							'15-25' => '15-25'
						],])
				->add('citys',ChoiceType::class, [
						'placeholder' => 'Город отправления',
						'required' => false,
						//'multiple' =>true,
						'choices'  => $this->get("cruise_service")->getCitys(),])	
				->add('tariff',ChoiceType::class, [
						'placeholder' => 'Тариф',
						'required' => false,
						'multiple' =>true,
						'choices'  => $this->get("cruise_service")->getTariff(),])			
				->add('direction',ChoiceType::class, [
						'placeholder' => 'Направление',
						'required' => false,
						'multiple' =>true,
						'choices'  => $this->get("cruise_service")->getDirection(),])			
				
				
				->add('category',ChoiceType::class, [
						'placeholder' => 'Любая категория',
						'required' => false,
						'multiple' =>true,
						'choices'  => $this->get("cruise_service")->getCategory(),
						'attr'=>['data-placeholder'=>'Любая']
						])					
				
				->add('ports',ChoiceType::class, [
						'placeholder' => 'Любые города',
						'required' => false,
						'multiple' =>true,
						'choices'  => $this->get("cruise_service")->getPorts(),
						'attr'=>['data-placeholder'=>'Любые города']
						])						
				
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
				
		$data = [];
		if ($form->isSubmitted() /*&& $form->isValid()*/) 
		{
			$data = $form->getData();

		}	
		$cruises = $this->get("cruise_service")->searchAction($data,$countInPage,$firstResult);
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
			LEFT JOIN r.roomType rt
			WHERE c.motorship IS NOT NULL
			AND c.archives = 0
			AND c.id = :id
			
			ORDER BY rt.priority ASC, r.number ASC
		";
		/// добавить в селект выборку по свободной каюте
		// каюты можно грузить отдельно, чтоб не напрягать память дублями круиза и теплохода
		$query = $em->createQuery($q);
		$query->setParameter('id', $id);
		$cruise = $query->getOneOrNullResult();
		
		if(null == $cruise)
		{
			throw $this->createNotFoundException("Круиз не найден");
		}
		
		$cruise->tariffs = $this->get('cruise_service')->getTariffs($cruise);
		//$prices = $this->get("cruise_service")->getPrices($cruise);
		
		$days = 1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
		$cruise->days = $days;
			
		// установим priceDays 
		if($cruise->getPriceDays() == 0)
		{
			// получим регион обслуживания
			if($cruise->getRegion() != null)
			{
				$region = $cruise->getRegion();
			}
			else
			{
				$region = $cruise->getMotorship()->getRegion();
			}
			$cruise->priceDaysFinal = $cruise->days - 1 + (int)$region->getPriceTypeTariff() ;  
			
		}
		else 
		{
			$cruise->priceDaysFinal = $cruise->getPriceDays();
		}
		
		$freeRoomsArray = [];
		foreach($freeRooms as $room)
		{
			$freeRoomsArray[$room["room_id"]] = $room["final_reserve"];
		}
		foreach($cruise->getMotorship()->getRoom() as $room)
		{
			$room->statuses = isset($freeRoomsArray[$room->getId()]) ? $freeRoomsArray[$room->getId()] : 1   ;
		}		

		
		$priceMatrix = $this->get("cruise_service")->getPriceMatrix($cruise);
		
		$decksJS = $priceMatrix['decksJS'];
		$decks   = $priceMatrix['decks'];
		$priceMin = $priceMatrix['priceMin'];
		
		$cruise->setPriceMin(ceil( (int)$priceMin/100)*100);
		$em->persist($cruise);
		$em->flush();
		
		$cruise->programm = $this->get("cruise_service")->getProgramm($cruise);
		$cruise->discount = $this->get("cruise_service")->getDiscounts($cruise);
		$cruise->tariffsHidden = $this->get('cruise_service')->getTariffs($cruise, true);
		
		
		
		return [
					"cruise" => $cruise,
					'decksJS' => $decksJS,
					'decks' => $decks,
					'bannerImg'=>'cruisetopbg.jpg',
					'bannerHtml' => $this->renderView("CruiseBundle:Cruise:cruiseh1.html.twig",["cruise" => $cruise])
					
					];
	}
}

