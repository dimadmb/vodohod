<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ForumController extends Controller
{

	 /**
	 * @Template()
	 * @Route("/json", name="json")
     */
    public function jsonAction(Request $request)
    {
		
		$json = array(
			"cruise_id" => 5482,
			"rooms" => array(
				"316"=>array(
					array(
					"tariff_id"=>1,
					"name"=>"Иван",
					"surname"=>"Иванов",
					"patronymic"=>"Иванович",
					"birthday"=>"1945-05-05",
					"pass_seria"=>"1233",
					"pass_num"=>"123456",
					"pass_date"=>"2000-05-05",
					"pass_who" => "кем выдан",
					),
					array(
					"tariff_id"=>1,
					"name"=>"Мария",
					"surname"=>"Иванова",
					"patronymic"=>"Ивановна",
					"birthday"=>"1955-05-05",
					"pass_seria"=>"1233",
					"pass_num"=>"123456",
					"pass_date"=>"2000-05-05",
					"pass_who" => "кем выдан",
					)
				),

			),
		);
		
		$je = json_encode($json);
		
		return  [$request,$je];
	}

	 /**
	 * @Template()	 
	 * @Route("/club/forums/{forum_id}/{theme_id}" , name="forum_theme")	 
     */
    public function themeAction($forum_id,$theme_id)
	{
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		$theme = $qb
				->select("ft,fm")
				->from("ForumBundle:ForumTheme","ft")
				->innerJoin("ft.forumMessages","fm" )
				
				->where("ft.id = ".$theme_id)
				
				->andWhere("ft.active = 1")
				->andWhere("ft.closed = 0")
				->andWhere("fm.active = 1")
				->andWhere("fm.block =  0")
				->andWhere("fm.moderation = 1")				
				->orderBy("fm.datetime","ASC")
				

				->getQuery()
				->getOneOrNullResult();
			;
				
		return ['forumTheme'=>$theme];
	}


	 /**
	 * @Template()	 
	 * @Route("/club/forums/{id}" , name="forum")	 
     */
    public function forumAction($id)
	{
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		
		$subqb = $em->createQueryBuilder();
		
		$subqb 
			->select('max(fm2.id)')
			->from('ForumBundle:ForumMessage','fm2')
				->andWhere("fm2.active = 1")    
				->andWhere("fm2.block =  0")           
				->andWhere("fm2.moderation = 1")
				->groupBy("fm2.forumTheme")
			;
			
		$forum = $qb
				->select('f,ft,fm,ftu,fmu')
				->from("ForumBundle:Forum","f")
				->leftJoin("f.forumTheme","ft")
				->leftJoin("ft.user","ftu")
				->leftJoin("ft.forumMessages","fm" )
				->leftJoin("fm.user","fmu")
				->where("f.id = ".$id)
				->andWhere("ft.active = 1")
				->andWhere("ft.closed = 0")
				
				
				->andWhere( $qb->expr()->in('fm.id',  $subqb->getDQL()))

				->orderBy("fm.datetime","DESC")
				->getQuery()
				->getOneOrNullResult();
			;
			
			
		
			

		foreach($forum->getForumTheme() as $theme)
		{
			$theme->countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($theme->getId()) - 1;
			
		}
			
		
		return ['forum'=>$forum];
	}
	
	 /**
	 * @Template()	 
     */
    public function indexAction()
    {
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		$forumGroups = $qb
				->select('fg')
				->from("ForumBundle:ForumGroup","fg")
				->leftJoin('fg.forum', 'f')
				->where("fg.active = 1")
				->orderBy("fg.sort","ASC")
				->addOrderBy("f.sort","ASC")
				->getQuery()
				->getResult();
			;			
		
		foreach($forumGroups as $forumGroup)
		{
			foreach($forumGroup->getForum() as $forum)
			{
				$forum->countThemes = $em->getRepository('ForumBundle:Forum')->getCountThemes($forum->getId());
				$forum->countAnswers = $em->getRepository('ForumBundle:Forum')->getCountAnswers($forum->getId());
				$forum->lastMessage = $em->getRepository('ForumBundle:Forum')->getLastMessage($forum->getId());
			}
		}
		return ['forumGroups'=>$forumGroups];
	}

	
}
