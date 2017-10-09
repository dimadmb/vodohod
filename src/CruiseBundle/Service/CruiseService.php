<?php
namespace CruiseBundle\Service;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//use Doctrine\ORM\EntityManager;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Config\Definition\Exception\Exception;
//use Symfony\Component\DependencyInjection\Container;

class CruiseService
{
    private $doctrine;
    private $knp_paginator;
    private $memcacheDefault;

    public function __construct($doctrine,$knp_paginator,$memcacheDefault)
    {
        $this->doctrine = $doctrine;
        $this->knp_paginator = $knp_paginator;
        $this->memcacheDefault = $memcacheDefault;
    }

	public function getProgramm($cruise)
	{
		$em = $this->doctrine->getManager('cruise');
		
		$cruiseTimeStamp = strtotime($cruise->getDateStart()->format("Y-m-d"));
		
		$cruise->cruiseTimeStamp = $cruiseTimeStamp;
		
		
		$qb = $em->createQueryBuilder();
		$qb
		->select('d,p')
		->from('CruiseBundle:CruiseDays','d')
		->leftJoin('d.port','p')
		->where('d.cruise = :cruise')
		->setParameter('cruise', $cruise)
		;
		$qb->orderBy('d.day','ASC');
		$qb->addOrderBy('d.timeStart','ASC');
		
		$days = $qb->getQuery()->getResult();
		
		$programms = [];
		foreach($days as $day)
		{
			//	вывод экскурсии
			$excursion_name = "";
			if(trim($day->getComment())!= "")
			{
				$excursion_name = $day->getComment();
			} 
			else 
			{
				if(null !==  $day->getExcursion()){
					$excursion_name=$day->getExcursion()->getDescription();
				} else {
					$excursion_name="Программа уточняется.";
				}
			}
			
			 
			// обработать  $excursion_name
			
		$excursion_name= "<p>".implode("</p><p>", (explode("\n",$excursion_name)))	. "</p>";
			
		//$excursion_name=str_replace("\n", "</p><p>", $excursion_name);
		
		$excursion_name=str_replace("Круиз+", "Круиз +", $excursion_name);
		$excursion_name=str_replace(" Круиз +:", " «Круиз +»:", $excursion_name);
		$excursion_name=str_replace(" \"Круиз +:\"", " «Круиз +»:", $excursion_name);
		
		$excursion_name=str_replace("\"шведский стол\"", "«шведский стол»", $excursion_name);
		
		$excursion_name=str_replace(" - ", " &mdash; ", $excursion_name);
		$excursion_name=str_replace(" – ", " &mdash; ", $excursion_name);
		
		if( mb_strpos($excursion_name, "Дополнитель")>-1){
			
			if(mb_strpos($excursion_name, "Дополнительная услуга")>-1 or mb_strpos($excursion_name, "Дополнительная экскурсия")>-1 or mb_strpos($excursion_name, "Дополнительные экскурсии")>-1 or mb_strpos($excursion_name, "Дополнительная программа:")>-1){
				

				$was_line=true;
				//$excursion_name=str_replace("Дополнительная услуга:", "</p><div style=\"color:red;\"><p><strong>Дополнительная услуга:</strong>", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительная экскурсия:", "</p><div style=\"color:#365f91;\"><p><strong>Дополнительная экскурсия:</strong>", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительные экскурсии:", "</p><div style=\"color:red;\"><p><strong>Дополнительные экскурсии:</strong>", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительные экскурсии.", "</p><div style=\"color:red;\"><p><strong>Дополнительные экскурсии.</strong>", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительная экскурсия ", "</p><div style=\"color:red;\"><p><strong>Дополнительная экскурсия</strong> ", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительные экскурсии ", "</p><div style=\"color:red;\"><p><strong>Дополнительные экскурсии</strong> ", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительные программы:", "</p><div style=\"color:red;\"><p><strong>Дополнительные программы:</strong> ", $excursion_name."</div>");
				//$excursion_name=str_replace("Дополнительная программа:", "</p><div style=\"color:red;\"><p><strong>Дополнительная программа:</strong> ", $excursion_name."</div>");
			}
			$excursion_name=str_replace("Дополнительная программа «Круиз +»:", ($was_line ? "" : "</p><p style=\"color:red;\">")."<strong>Дополнительная программа «Круиз +»:</strong>", $excursion_name);
			if(mb_strpos($excursion_name, "«Круиз +»")>-1){
				$excursion_name=str_replace("Основная программа:", "</p><p>Основная программа:", $excursion_name);
			}
			//$excursion_name=ereg_replace("Дополнительн", "Дополнительн", $excursion_name.$to_link."</div>");
		}
		//$excursion_name=str_replace("<p>&nbsp;</p>", "", $excursion_name);
		
		$excursion_name=str_replace("\" ", "» ", $excursion_name);
		$excursion_name=str_replace("(\"", "(«", $excursion_name);
		$excursion_name=str_replace(" \"", " «", $excursion_name);
		$excursion_name=str_replace("\".", "».", $excursion_name);
		$excursion_name=str_replace("\",", "»,", $excursion_name);
		$excursion_name=str_replace("\")", "»)", $excursion_name);
		$excursion_name=str_replace("¶", "</p></p>", $excursion_name);
		$excursion_name=str_replace("еленая ", "елёная ", $excursion_name);
		$excursion_name=str_replace("Зелёная стоянка", "«Зелёная стоянка»", $excursion_name);
		$excursion_name=str_replace("\"Зелёная стоянка\"", "«Зелёная стоянка»", $excursion_name);
		$excursion_name=str_replace("зелёная стоянка", "«зелёная стоянка»", $excursion_name);
		$excursion_name=str_replace("««", "«", $excursion_name);
		$excursion_name=str_replace("»»", "»", $excursion_name);
		$excursion_name=str_replace("сухой паек", "сухой паёк", $excursion_name);			
			
			
			
			$day->finalDescription = $excursion_name;
						
			
			$datetime = new \DateTime();
			$datetime->setTimestamp($day->getTimeStart()->getTimestamp() + $cruiseTimeStamp + 10800 + ($day->getDay()-1)*86400 );
			$day->setTimeStart($datetime);
			
		}
		
		
		return $days;
	}

	public function getTariffs($cruise, $hide = false)
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT t
			FROM CruiseBundle:Tariff t
			LEFT JOIN t.cruiseTariff ct
			WHERE t.hideInTables = ".(int)$hide."
			AND   t.active = 1	
			AND   (
						(
								  t.toAllCruises = 1 
							AND   t.isInShop = 1
						) 
						OR
						(
							ct.cruise = ".$cruise->getId()."
						)
				  )
		";
		$query = $em->createQuery($sql);
		return $query->getResult();
	}

	public function getDiscounts($cruise)
	{
		$em = $this->doctrine->getManager('cruise');
		$q = "SELECT d
			FROM CruiseBundle:Discount d
			WHERE d.toAllCruises = 1 
			AND d.active = 1
			AND d.hideInTables = 0 
			AND d.isInShop = 1
			AND (
				(d.cruiseDateStart <= :cruiseDateStart	AND d.cruiseDateStop >= :cruiseDateStop) 
				OR 
				(d.cruiseDateStart = '000-00-00' AND (d.payingDateStart <= CURRENT_TIMESTAMP()	AND d.payingDateStop >= CURRENT_TIMESTAMP()))
				)
			ORDER BY d.priority
		";
		$query = $em->createQuery($q)
		->setParameters([
			'cruiseDateStart'=>$cruise->getDateStart(),
			'cruiseDateStop'=>$cruise->getDateStop(),
		]);

		$discounts = $query->getResult();
		
		return $discounts;
	}
	
	public function getPrices($cruise)
	{
		$em = $this->doctrine->getManager('cruise');
		
		$q = "SELECT p,rt,mr
			FROM CruiseBundle:Price p
			LEFT JOIN p.roomType rt
			LEFT JOIN rt.motorshipRooms mr 
			WHERE p.year = ".$cruise->getDateStart()->format("Y")."
			AND p.motorship = ".$cruise->getmotorship()->getId()."
			AND p.active = 1
			AND p.additional = 0
			AND p.cruise IS NULL 
			".
			"AND ( mr.motorship = ".$cruise->getmotorship()->getId()." OR mr.motorship IS NULL)
			"."
			ORDER BY p.deck DESC , rt.priority ASC, p.roomPlacing ASC
		";
		$query = $em->createQuery($q);
		$prices = $query->getResult();
			
		$q = "SELECT p,rt,mr
			FROM CruiseBundle:Price p
			LEFT JOIN p.roomType rt
			LEFT JOIN rt.motorshipRooms mr 
			WHERE p.year = ".$cruise->getDateStart()->format("Y")."
			AND p.motorship = ".$cruise->getmotorship()->getId()."
			AND p.active = 1
			AND p.additional = 0
			AND p.cruise =  ".$cruise->getId()."
			
			AND ( mr.motorship = ".$cruise->getmotorship()->getId()." OR mr.motorship IS NULL)

			ORDER BY p.deck DESC , rt.priority ASC, p.roomPlacing ASC
		";
		$query = $em->createQuery($q);
		$prices_cruise = $query->getResult();	



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
		
		$koef = $cruise->priceDaysFinal * $cruise->getPriceKoef();
		
		foreach($prices as $price)
		{
			$price->price = (int)($price->getValue()*$koef);	
			//print_r($price->getValue().'<hr style="border:1px solid #0f0;">');
			
			
			
			foreach($prices_cruise as $price_cruise)
			{
				if(
				($price_cruise->getMotorship() == $price->getMotorship())  && 
				($price_cruise->getDeck() == $price->getDeck())  && 
				($price_cruise->getRoomType() == $price->getRoomType())  && 
				($price_cruise->getRoomPlacing() == $price->getRoomPlacing())  && 
				(true) 
				)
				{
					$price->price = (int)($price_cruise->getValue());
					//print_r($price->getValue().'<hr style="border:1px solid #f00;">');
					
				}
				else
				{

					// $price->setValue($price->getValue()*$koef);	
				}
			}
			
			
			//$price->setValue($price->getValue()*$koef);
		}
		
		return $prices;
	}

	public function searchAction($search,$countInPage = 25,$firstResult = 1)
	{
		$request =  Request::createFromGlobals();
		
		$em = $this->doctrine->getManager('cruise');
		//$em = $this->doctrine->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');
		$qb = $em->createQueryBuilder();
		 $qb
		->select('c,m,ccd,ccdp')
        ->from('CruiseBundle:Cruise','c')
		->leftJoin('c.motorship', 'm')
		->leftJoin('c.cruiseDays', 'ccd')
		->leftJoin('ccd.port', 'ccdp')
		
        ->where('c.motorship IS NOT NULL')
		
		->andWhere('c.archives = 0')
		->andWhere('c.forSale = 1')
		->andWhere('c.dateStop > CURRENT_DATE()')
		;
		
		$qb->setMaxResults($countInPage);
		$qb->setFirstResult($countInPage*$firstResult);	

		$data = $search;
			// теплоходы
			if(isset($data['motorship']) && count($data['motorship']) > 0)
			{
				$in = [];
				foreach($data['motorship'] as $motorship)
				{	$in[] = $motorship->getId();	}
				$qb->andWhere('c.motorship in ('.implode(",",$in).')');
			}
			// класс теплохода
			if(isset($data['class']) && count($data['class']) > 0)
			{
				$in = [];
				foreach($data['class'] as $class)
				{	$in[] = $class->getId();	}
				$qb->andWhere('m.motorshipClass in ('.implode(",",$in).')');
			}
			// дней в круизе
			if(isset($data['days']) && null != $data['days'])
			{
				$days = $data['days'];
				list($dmin,$dmax) = explode("-",$days);
				$qb->andWhere("DATE_DIFF(c.dateStop ,c.dateStart )  >= $dmin - 1 ");
				$qb->andWhere("DATE_DIFF(c.dateStop ,c.dateStart )  <= $dmax - 1 ");
			}
			// дата старта
			if(isset($data['dateStart']) && null != $data['dateStart'])
			{
				$dateStart = $data['dateStart'];
				$qb->andWhere('c.dateStart >= :datestart');
				$qb->setParameter('datestart', $dateStart);
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
					$qb->orderBy('c.priceMin','ASC');
				}
				if($data['sortable'] == '4')
				{
					$qb->orderBy('c.priceMin','DESC');
				}
			}
			else
			{
				$qb->orderBy('c.dateStart','ASC');
			}
			$qb->addOrderBy('ccd.day', 'ASC');
			$qb->addOrderBy('ccd.timeStart', 'ASC');

			
			
		    $paginator  = $this->knp_paginator;
			$cruises = $paginator->paginate(
				$qb, 
				$request->query->getInt('page', 1)/*page number*/,
				$countInPage,
				["wrap-queries"=>true]
			);

		
		//if(null != $request->query->get('ajax')) return new Response(count($cruises));
				
		$cruiseRoomStatusRepository = $em->getRepository('CruiseBundle:CruiseRoomStatus');
		foreach($cruises as $cruise)
		{

			if(false !==  $countFreeRoom = $this->memcacheDefault->get('countFreeRoom'.$cruise->getId()) )
			{$cruise->freeCountRoom = $countFreeRoom;}
			else
			{
				$cruise->freeCountRoom = $cruiseRoomStatusRepository->countFreeRoom($cruise->getId());
				$this->memcacheDefault->set('countFreeRoom'.$cruise->getId(),$cruise->freeCountRoom,0,60*60*1);  // час 
			}
			
			$days = 1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
			$cruise->days = $days;
					
			$cruise->setName(str_replace([" - "," – "], [" — "," — "],$cruise->getName()));  // Стандартизируем название
			
			$array_port_from_cruise_name=explode(" — ", $cruise->getName()); // получаем массив городов из названия
			for($i=0; $i<sizeof($array_port_from_cruise_name); $i++){
				if(mb_strpos($array_port_from_cruise_name[$i], ' (')>0){
					$array_port_from_cruise_name[$i]=mb_substr($array_port_from_cruise_name[$i], 0, mb_strpos($array_port_from_cruise_name[$i], ' ('));
				}
			}
				// дополнительные порты (можно кинуть в кеш )		
			$portsPlus = [];
			foreach($cruise->getCruiseDays() as $cruiseDays)
			{
				$port_for_array = str_replace(["Москва (Северный речной вокзал)","Санкт-Петербург (причал «Уткина заводь»)"],["Москва","Санкт-Петербург"],$cruiseDays->getPort()->getName()) ;
				if( (! in_array($port_for_array, $array_port_from_cruise_name)) and $port_for_array!='День на борту'){
					$array_port_from_cruise_name[] = $port_for_array;
					$portsPlus[] = $port_for_array;
				}
			}
			$cruise->portsPlus = $portsPlus;
			
			if($cruise->getPriceMin() == 0 ) ///  Считаем минимальную цену, если нет
			{
				
				$prices = $this->getPrices($cruise);


				$priceMin = null;
				foreach($prices as $price)
				{
					$priceMin = (null == $priceMin || $price->price < $priceMin) ? $price->price : $priceMin;
				}
				
				$cruise->setPriceMin(ceil($priceMin/100)*100);
				$em->persist($cruise);
				$em->flush();				
			}
			
			

		}

		return 	$cruises ;
	}
	
	
	

}