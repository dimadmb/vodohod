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
		$dump = [];
		
		$dump['init'] = round(memory_get_usage()/1024/1024,2);
		
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
		
		
		$q = "SELECT p,rt,mr
			FROM CruiseBundle:Price p
			LEFT JOIN p.roomType rt
			LEFT JOIN rt.motorshipRooms mr 
			WHERE p.year = ".$cruise->getDateStart()->format("Y")."
			AND p.motorship = ".$cruise->getmotorship()->getId()."
			AND p.active = 1
			AND p.additional = 0
			AND p.cruise IS NULL 
			
			AND mr.motorship = ".$cruise->getmotorship()->getId()."

			ORDER BY p.deck DESC , rt.priority ASC, p.roomPlacing ASC
		";
		$query = $em->createQuery($q);
		$prices = $query->getResult();

		
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
		$decks = [];
		$priceMin = null;
		foreach($prices as $price)
		{
			$priceMin = (null == $priceMin || $price->getValue() < $priceMin) ? $price->getValue() : $priceMin;
			$arr_rooms = [];
			foreach($cruise->getMotorship()->getRoom() as $room)
			{
				if($room->getDeck() == $price->getDeck() && $room->getRoomType() == $price->getRoomType())
				{
					$arr_rooms[] = $room;
				}
			}
			$price->rooms = $arr_rooms; // список кают в данном прайсе.ы
			
			$decks[$price->getDeck()->getName()][] = $price;
			
		}
		$cruise->setPriceMin(ceil($cruise->priceDaysFinal * $cruise->getPriceKoef() * $priceMin/100)*100);
		$em->persist($cruise);
		$em->flush();
		
		$freeRoomsArray = [];
		foreach($freeRooms as $room)
		{
			$freeRoomsArray[$room["room_id"]] = $room["final_reserve"];
		}
		foreach($cruise->getMotorship()->getRoom() as $room)
		{
			$room->setStatus(  isset($freeRoomsArray[$room->getId()]) ? $freeRoomsArray[$room->getId()] : 1   );
		}
		
		
		$cruise->tariffs = $this->get('cruise_service')->getTariffs($cruise);
		
		
		$dump['return'] = round(memory_get_usage()/1024/1024,2);

		

		
		
		return ["cruise" => $cruise, 'dump'=>$dump, 'freeRoomsArray'=>$freeRoomsArray , 'decks' => $decks,  "prices"=>$prices, 'bannerImg'=>'cruisetopbg.jpg', 'bannerHtml' => $this->renderView("CruiseBundle:Cruise:cruiseh1.html.twig",["cruise" => $cruise])];
	}
}

