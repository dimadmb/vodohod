<?php
namespace CruiseBundle\Service;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//use Doctrine\ORM\EntityManager;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Config\Definition\Exception\Exception;
//use Symfony\Component\DependencyInjection\Container;



use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class CruiseService
{
    private $doctrine;
    private $knp_paginator;
    private $memcacheDefault;
    private $form;
    private $twig;

    public function __construct($doctrine,$knp_paginator,$memcacheDefault,$form,$twig)
    {
        $this->doctrine = $doctrine;
        $this->knp_paginator = $knp_paginator;
        $this->memcacheDefault = $memcacheDefault;
        $this->form = $form;
        $this->twig = $twig;
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
			
			
			$was_line=true;
			if(mb_strpos($excursion_name, "Дополнительная услуга")>-1 or mb_strpos($excursion_name, "Дополнительная экскурсия")>-1 or mb_strpos($excursion_name, "Дополнительные экскурсии")>-1 or mb_strpos($excursion_name, "Дополнительная программа:")>-1){
				

				
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

	public function getTariffs($cruise, $hide = false, $toAllCruises = true)
	{
		$em = $this->doctrine->getManager('cruise');
		$parameters = ['cruiseDateStart'=>$cruise->getDateStart()];
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
								t.toAllCruises = 0
							AND	ct.cruise = ".$cruise->getId()."
						)
				  )
			AND (
					(
							t.cruiseDateStart = '0000-00-00' 
						AND t.cruiseDateStop = '0000-00-00'
					) 
					OR 
					(
							:cruiseDateStart > t.cruiseDateStart
						AND :cruiseDateStart < t.cruiseDateStop
					)
				) 
		";
		if(!$hide) $sql .= " AND t.isTariffWithoutPlace = 0 ";
		if(false == $toAllCruises) 
		{
			$sql .= " AND t.toAllCruises = :toAllCruises ";
			$parameters['toAllCruises'] = $toAllCruises;
		}
		// добавить временнЫе ограничения
		$query = $em->createQuery($sql)		
		->setParameters($parameters);
		
		
		return $query->getResult();
	}

	public function getDiscounts($cruise,$exclusions = false)
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


	public function getPriceKoef($cruise)
	{
		$cruise->days =  1 + (strtotime($cruise->getDateStop()->format("Y-m-d")) - strtotime($cruise->getDateStart()->format("Y-m-d")))/86400;
		
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
		
		return $koef = $cruise->priceDaysFinal * $cruise->getPriceKoef();		
	}
	
	public function getPrices($cruise,$price = null)
	{
		$em = $this->doctrine->getManager('cruise');
		
		$priceWhere = (null === $price) ? "" : "AND p.id = ".$price->getId() ;
		
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
			".$priceWhere."
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
			".$priceWhere."
			ORDER BY p.deck DESC , rt.priority ASC, p.roomPlacing ASC
		";
		$query = $em->createQuery($q);
		$prices_cruise = $query->getResult();	

		
		$koef = $this->getPriceKoef($cruise);



		
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
			
			
			
			// порты отправления
			if(isset($data['citys']) && null != $data['citys'])
			{
				$citys = $data['citys'];
				
				if(is_string($citys))
				{
					$qb->andWhere("c.name like '$citys%'");
					//$qb->setParameter('citys', $citys);					
				}
				elseif(is_array($citys))
				{
					
				}

			}
			
			// месяц
			if(isset($data['months']) && null != $data['months'])
			{
				$months = $data['months'];
				$qb->andWhere("c.dateStart like '$months%'");
			}		
			
			// тарифы
			if(isset($data['tariff']) && null != $data['tariff'])
			{
				$tariff = $data['tariff'];
				$qb->leftJoin('c.cruiseTariff', 'ct');
				$qb->andWhere("ct.tariff IN (:tariff) ");
				$qb->setParameter('tariff', $tariff);
			}
			
			// направления
			if(isset($data['direction']) && null != $data['direction'])
			{
				$direction = $data['direction'];
				//$qb->add("LEFT JOIN c.category" , "cc");
				
				$qb->leftJoin('c.category', 'cc');
				$qb->andWhere("cc.id IN (:direction) ");
				$qb->setParameter('direction', $direction);
			}			
			// category
			if(isset($data['category']) && null != $data['category'])
			{
				$category = $data['category'];
				//$qb->add("LEFT JOIN c.category" , "cc");
				
				$qb->leftJoin('c.category', 'cc');
				$qb->andWhere("cc.id IN (:category) ");
				$qb->setParameter('category', $category);
			}			
						
			// порты посетить 
			if(isset($data['ports']) && null != $data['ports'])
			{
				$ports = $data['ports'];
				//$qb->add("LEFT JOIN c.category" , "cc");
				
				$qb->leftJoin('c.cruiseDays', 'cd');
				$qb->andWhere("cd.port IN (:ports) ");
				$qb->setParameter('ports', $ports);
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
			

			if(false !==  $ts = $this->memcacheDefault->get('tariffToNoAllCruises'.$cruise->getId()) )
			{$cruise->ts = $ts;}
			else
			{
				dump($this->getCruiseCategory($cruise));
				
				$cruise->ts = array_merge($this->getTariffs($cruise,false,false),$this->getCruiseCategory($cruise));
				$this->memcacheDefault->set('tariffToNoAllCruises'.$cruise->getId(),$cruise->ts,0,60*60*1);  // час 
			}

			
			///$cruise->ts=$this->getTariffs($cruise,false,false);
			
			/// её можно перенести в Entity\Cruise getDays()
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
				$port_for_array = str_replace(["Москва (Северный речной вокзал)","Санкт-Петербург (причал «Уткина заводь»)","Санкт-Петербург (причал «Соляной причал»)"],["Москва","Санкт-Петербург","Санкт-Петербург"],$cruiseDays->getPort()->getName()) ;
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
	
	public function miniFormSearchAction()
	{
		
		$request =  Request::createFromGlobals();


		$form = $this->form->createNamedBuilder(null,FormType::class,null, ['csrf_protection' => false,'validation_groups' => false])
		
				->add('days',ChoiceType::class, [
						'placeholder' => 'Количество дней',
						'required' => false,
						'choices'  => [
							'1-4' => '1-4',
							'5-7' => '5-7',
							'8-10' =>'8-10',
							'11-14' => '11-14',
							'15-23' => '15-23'
						],])		
				->add('months',ChoiceType::class, [
						'placeholder' => 'Месяц',
						'required' => false,
						'choices'  => $this->getMonths(),])		
				->add('citys',ChoiceType::class, [
						'placeholder' => 'Город отправления',
						'required' => false,
						'choices'  => $this->getCitys(),])

				->add('submit', SubmitType::class,array('attr'=>[ 'class'=> 'btn btn-red full-width']))
				->setMethod('GET')
				//->setAction($this->generateUrl('cruises'))
				->getForm()	
		;
		
		//$this->getDirection();
				
		$form->handleRequest($request);	
				
		$data = [];
		if ($form->isSubmitted() /*&& $form->isValid()*/) 
		{
			$data = $form->getData();

		}	
		return [ "form"=> $form->createView()];						
	 
	}	
	
	public function getMonths()
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT c.dateStart, MONTH(c.dateStart) AS month, YEAR(c.dateStart) AS year
			FROM CruiseBundle:Cruise c
			WHERE c.dateStop >= CURRENT_TIMESTAMP()
			GROUP BY year,month
		";
		$query = $em->createQuery($sql);
		
		$cruises = $query->getResult();
		
		$res = [];
		foreach($cruises as $cruise)
		{
			$res[$this->twig->render("CruiseBundle:Service:date.html.twig", ['cruise'=>$cruise])] = $cruise['dateStart']->format("Y-m");
		}
		//dump($cruises);
		
		return $res;
	}

	public function getCitys()
	{
		return [
			'Москва' => 'Москва',
			'Санкт-Петербург' => 'Санкт-Петербург', 
			'Астрахань' => 'Астрахань',
			'Волгоград' => 'Волгоград',
			'Казань' => 'Казань',
			'Нижний Новгород' => 'Нижний Новгород',
			'Самара' => 'Самара',
			'Саратов' => 'Саратов',
		];
	} 
	
	public function getTariff()
	{
		return [
			'Пенсионный' => 13,
			'Студенческий' => 15,
			'Школьный' => 17,
		];
	}  
	
	public function getDirection()
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT cc,c
			FROM CruiseBundle:CruiseCategory cc
			LEFT JOIN cc.cruises c
			WHERE cc.name LIKE '..%'
			AND c.dateStart >= CURRENT_TIMESTAMP()
			AND c.id IS NOT NULL
			GROUP BY cc.id
		";

		$query = $em->createQuery($sql);
		
		$categories = $query->getResult();
				
		$res = [];
		foreach($categories as $category)
		{
			$res[trim($category->getName(),'.')] = $category->getId();
		}
		
		return $res;
	} 


	
	public function getCruiseCategory($cruise)	
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT cc
			FROM CruiseBundle:CruiseCategory cc
			LEFT JOIN cc.cruises c 
			WHERE cc.name NOT LIKE '.%'
			AND cc.name NOT LIKE '..%'
			AND c.id = :cruise
		";	
		$query = $em->createQuery($sql)
		->setParameters(['cruise'=>$cruise])
		;
		
		$categories = $query->getResult();
		
		//dump($categories);
		
		return($categories);
	}
	
	public function getCategory()
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT cc,c
			FROM CruiseBundle:CruiseCategory cc
			LEFT JOIN cc.cruises c
			WHERE cc.name NOT LIKE '.%'
			AND cc.name NOT LIKE '..%'
			AND c.dateStart >= CURRENT_TIMESTAMP()
			AND c.id IS NOT NULL
			GROUP BY cc.id
		";
		$query = $em->createQuery($sql);
		
		$categories = $query->getResult();
				
		$res = [];
		foreach($categories as $category)
		{
			$res[trim($category->getName(),'.')] = $category->getId();
		}
		
		return $res;
	} 
	
	public function getPorts()
	{
		$em = $this->doctrine->getManager('cruise');
		$sql = "
			SELECT p
			FROM CruiseBundle:Port p
			LEFT JOIN p.cruiseDays cd 
			LEFT JOIN cd.cruise c

			WHERE c.dateStart >= CURRENT_TIMESTAMP()
			AND c.id IS NOT NULL
			
			AND p.name NOT LIKE '%борт%'
			
			GROUP BY p.id
			ORDER BY p.name
		";
		$query = $em->createQuery($sql);
		
		$ports = $query->getResult();
				
		$res = [];
		foreach($ports as $port)
		{
			$res[trim($port->getName(),'.')] = $port->getId();
		}
		
		return $res;
	} 
	
	public function getPriceMatrix($cruise, $imagesOn = true)
	{
		$em_base = $this->doctrine->getManager();
		$prices = $this->getPrices($cruise);

		
		$decks = [];
		$decksJS = [];
		$priceMin = null;
		foreach($prices as $price)
		{
			$priceJS = [];
			
			$priceJS['id'] = $price->getId();
			$priceJS['price'] = $price->price;
			$priceJS['places']= $price->getRoomPlacing()->getPlaces();	
			
			
			$tariffJS = [];
			foreach($cruise->tariffs as $tariff)
			{
				if($tariff->getIsTariffPrivilege() <= $price->getPrivilege())
				{
				if($tariff->getIsTariffChildren() <= $price->getChildren()) 
				{
					
					$tariffJS['name'] = $tariff->getName();
					$tariffJS['price'] = ceil($price->price/100) * (100 + $tariff->getValue());
				
				$priceJS['tariff'][] = $tariffJS;
				}
				}	
			}
			
			
			$decription = '';
			foreach($price->getRoomType()->getMotorshipRooms() as $motorshipRooms)
			{
				$decription = $motorshipRooms->getComment();
			}			
			$priceJS['description'] = $decription;
			
			
			$priceMin = (null == $priceMin || $price->price < $priceMin) ? $price->price : $priceMin;
			$arr_rooms = [];
			$arr_roomsJS = [];
			
			foreach($cruise->getMotorship()->getRoom() as $room)
			{
				if($room->getDeck() == $price->getDeck() && $room->getRoomType() == $price->getRoomType())
				{
					$arr_rooms[] = $room;
					
					if($room->statuses == 0 )
					{
						if (  ($price->getRoomPlacing()->getPlaces() == $room->getRoomType()->getPlacesMax()) or (($room->getRoomType()->getPlacesMax() >= $price->getRoomPlacing()->getPlaces()) and $room->getSmaller() == 1)	)				
						{	
							$arr_roomsJS[] = ['number'=>$room->getNumber() , 'id' => $room->getId()] ;
						}
					}
					
				}
			}
			$price->rooms = $arr_rooms; // список кают в данном прайсе.ы
			$priceJS['rooms'] = $arr_roomsJS; // список кают в данном прайсе.ы
			$priceJS['name'] = $price->getName() != "" ? $price->getName() : $price->getRoomType()->getComment();			
			
			if($imagesOn)
			{
			// нужно добавить фотки 
			$images = $em_base->getRepository("BaseBundle:MotorshipRoomImage")->findOneBy([
							'motorship'=> $price->getMotorship()->getId(),
							'deck'=> $price->getDeck()->getId(),
							'roomType'=> $price->getRoomType()->getId(),
						],
						[
							'sort'=>'ASC',
							'id'  =>'ASC'
						]);
			$price->images = $images;
			$priceJS['images'] = $images;
			}
			
			$decks[$price->getDeck()->getName()][] = $price;
			$decksJS[$price->getDeck()->getName()][] = $priceJS;
			
		}
	return['decks'=>$decks, 'decksJS'=>$decksJS, 'priceMin'=>$priceMin ];
	}
	
	
	public function getPriceBasket($cruise, $room, $price)
	{
		//$price = $this->getPrices($cruise,$price)[0];
		$koef = $this->getPriceKoef($cruise);
		$price->price = (int)($price->getValue()*$koef);
		
			$priceJS = [];
			foreach($cruise->tariffs as $tariff)
			{
				if($tariff->getIsTariffPrivilege() <= $price->getPrivilege())
				{
				if($tariff->getIsTariffChildren() <= $price->getChildren()) 
				{
					
					$tariffJS['name'] = $tariff->getName();
					$tariffJS['price'] = ceil($price->price/100) * (100 + $tariff->getValue());

				
				$priceJS[] = $tariffJS;
				}
				}	
			}
			
		return $priceJS;
	}
	
}