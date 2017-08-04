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
	

	public function getTariffs($cruise, $all = false)
	{
		$em = $this->doctrine->getManager('cruise');
		$tariffs = [];
		$tariffs = $em->getRepository('CruiseBundle:Tariff')->findBy([
										'toAllCruises'=>true,
										'active'=> true,
										'hideInTables' => false,
										'isInShop' => true
										]);
		
		
		$qb = $em->createQueryBuilder();
		$qb
		->select('ct,t')
		->from('CruiseBundle:Tariff','t')
		->leftJoin('t.cruiseTariff', 'ct')
		->where('t.active = 1')
		->andWhere('ct.cruise = :cruise')
		->setParameter('cruise', $cruise)
		;
		
		if(!$all) $qb->andWhere('t.hideInTables = 0');

		$qb->orderBy('t.priority','ASC');
		
		$cruiseTariffs = $qb->getQuery()->getResult();		
		
		// можно взять тарифф и приклеить слева cruiseTriff 
		
		//SELECT * FROM `tariff` 
		//right outer join `cruise_tariff` on `cruise_tariff`.`tariff_id` = `tariff`.`id` 
		//WHERE  `cruise_tariff`.`cruise_id` = 3533
		
		// тогда получим на выходе список тарифов 
		
		// не забыть про условия отбора 
		
		
		
		return array_merge($tariffs,$cruiseTariffs);
	}


	public function searchAction($search,$countInPage = 1000,$firstResult = 1)
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
				$prices = $em->getRepository('CruiseBundle:Price')->findBy([
						"year"=>$cruise->getDateStart()->format("Y"),
						"motorship"=>$cruise->getmotorship(),
						"active"=>true,
						"additional"=>false,
						"cruise"=>null,
						],["deck"=>"DESC"]);
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
				$priceMin = null;
				foreach($prices as $price)
				{
					$priceMin = (null == $priceMin || $price->getValue() < $priceMin) ? $price->getValue() : $priceMin;
				}
				$cruise->setPriceMin(ceil($cruise->priceDaysFinal * $cruise->getPriceKoef() * $priceMin/100)*100);
				$em->persist($cruise);
				$em->flush();				
			}
			
			

		}

		return 	$cruises ;
	}

}