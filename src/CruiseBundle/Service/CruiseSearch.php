<?php
namespace CruiseBundle\Service;

//use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

//use Doctrine\ORM\EntityManager;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
//use Symfony\Component\Config\Definition\Exception\Exception;
//use Symfony\Component\DependencyInjection\Container;

class CruiseSearch
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
	
	public function getCruisesAction($search,$countInPage = 1000,$firstResult = 1)
	{
		$request =  Request::createFromGlobals();
		
		$em = $this->doctrine->getManager('cruise');
		//$em = $this->doctrine->getManager("cruise");
		$cruiseRepository = $em->getRepository('CruiseBundle:Cruise');
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
			
		    $paginator  = $this->knp_paginator;
			$cruises = $paginator->paginate(
				$qb, 
				$request->query->getInt('page', 1)/*page number*/,
				$countInPage 
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
		}

		return 	$cruises ;
	}


    public function getHappyMessage()
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);

        return $messages[$index];
    }
}