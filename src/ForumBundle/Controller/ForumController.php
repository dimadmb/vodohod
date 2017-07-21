<?php

namespace ForumBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

//use Doctrine\ORM\Tools\Pagination\Paginator;

use ForumBundle\Entity\ForumMessage;
use ForumBundle\Entity\ForumTheme;



use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ForumController extends Controller
{



	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/{forum_id}/addintheme/{message_id}/{theme_id}" , name="forum_add_in_theme")	 
     */	
	public function addInThemeAction($forum_id, $message_id, $theme_id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		
		$message = $em->getRepository("ForumBundle:ForumMessage")->findOneById($message_id);
		$theme   = $em->getRepository("ForumBundle:ForumTheme")->findOneById($theme_id);
		
		$message->setForumTheme($theme)
				->setModeration(true)
		;
		
		$em->persist($message);
		$em->flush();
		
			$countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($message->getForumTheme()->getId());
			
			if($countAnswers == 0) return $this->redirectToRoute('forum',['id'=>$message->getForumTheme()->getForum()->getId()]);
			
			return $this->redirectToRoute('forum_theme',[
			'forum_id'=>$message->getForumTheme()->getForum()->getId(),
			'theme_id'=>$message->getForumTheme()->getId(),
			'p'=> ceil($countAnswers/20)
			]);	
	}
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/{forum_id}/addmessagein/{message_id}" , name="forum_add_message_in")	 
     */	
	public function addMessageInAction($forum_id, $message_id, Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$message = $em->getRepository("ForumBundle:ForumMessage")->findOneById($message_id);
		
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
				->where("f.id = ".$forum_id)
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
			
		
		return [ 'forum'=>$forum, 'message'=>$message ];
	}
	
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/{forum_id}/newtheme" , name="forum_new_theme")	 
     */	
	public function newThemeAction($forum_id, Request $request)
	{
		
		$em = $this->getDoctrine()->getManager();
		$forum = $em->getRepository('ForumBundle:Forum')->findOneById($forum_id);
		
		
		if ($forum == null) {
			throw $this->createNotFoundException("Форума с таким ID не существует.");
		}		
		
		$form = $this->createFormBuilder()
				->add('name', TextType::class,array('label' => 'Название темы'))
				->add('comment', TextType::class,array('label' => 'Комментарий к теме', 'required'=>false))
				->add('body', TextareaType::class,array('label' => 'Ваше сообщение'))
				->add('submit', SubmitType::class,array('label' => 'Отправить'))
				->getForm()
			;	
		$form->handleRequest($request);


		if ($form->isSubmitted() && $form->isValid()) 
		{
			$forumTheme = new ForumTheme();
			$forumTheme
					->setName($form->getData()['name'])
					->setComment($form->getData()['comment'])
					->setActive(true)
					->setDatetime(new \Datetime())
					->setClosed(false)
					->setSubscriber("")
					->setForum($forum)
					->setUser($this->getUser())
			;
			$em->persist($forumTheme);
			
			$newMessage = new ForumMessage();
			$newMessage
					->setForumTheme($forumTheme)
					->setUser($this->getUser())
					->setDatetime(new \Datetime())
					->setModeration(false)
					->setActive(true)
					//->setReplayId($message)
					->setBlock(false)
					->setBody($form->getData()['body'])
					->setQuote("")
					;
			$em->persist($newMessage);
			$em->flush();

			$body = $this->renderView('ForumBundle:Forum:moderationNewTheme.html.twig',['newMessage'=>$newMessage]);
			$mailer = $this->get('mailer');
			$message_swift = \Swift_Message::newInstance()
			->setSubject('Премодерация форума => Новая тема в форум ' .$form->getData()['name'])
			->setFrom(array('nobody@vodohod.com'=>'Форум'))
			->setTo(array($this->getParameter('email_forum_moderator')))
			->setBcc(array('dkochetkov@vodohod.ru'))
			->setBody($body, 'text/html')
			;
			$mailer->send($message_swift);	
			
			return $this->redirectToRoute('forum',['id'=>$forum->getId()]);				
			
		}
		
		
		
		return ['form'=>$form->createView(),'forum'=>$forum];
	}
	
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/moderation/{message_id}/{confirm}" , name="forum_moderation")	 
     */	
	public function moderationAction($message_id, $confirm)
	{
		$this->denyAccessUnlessGranted('ROLE_ADMIN_MODER', null, 'Unable to access this page!');
		
		$em = $this->getDoctrine()->getManager();
		$message = $this->getDoctrine()->getRepository("ForumBundle:ForumMessage")->findOneById($message_id);
		
		$message->setModeration( $confirm == "true" ? true : false );
		
		$em->persist($message);
		$em->flush();		
		
			$countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($message->getForumTheme()->getId());
			
			if($countAnswers == 0) return $this->redirectToRoute('forum',['id'=>$message->getForumTheme()->getForum()->getId()]);
			
			return $this->redirectToRoute('forum_theme',[
			'forum_id'=>$message->getForumTheme()->getForum()->getId(),
			'theme_id'=>$message->getForumTheme()->getId(),
			'p'=> ceil($countAnswers/20)
			]);	
	}
	 
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/quote/{message_id}" , name="forum_quote")	 
     */	
	public function quoteAction($message_id, Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
		$em = $this->getDoctrine()->getManager();
		$message = $this->getDoctrine()->getRepository("ForumBundle:ForumMessage")->findOneById($message_id);
		$form = $this->createFormBuilder()
				->add('body', TextareaType::class,array('label' => 'Ваше сообщение'))
				->add('quote', TextareaType::class,array('label' => 'Текст цитаты', 'data'=>$message->getBody()))
				->add('submit', SubmitType::class,array('label' => 'Отправить'))
				->getForm()
			;	
		$form->handleRequest($request);	
		
		if ($form->isSubmitted() && $form->isValid()) 
		{
			$newMessage = new ForumMessage();
			$newMessage
					->setForumTheme($message->getForumTheme())
					->setUser($this->getUser())
					->setDatetime(new \Datetime())
					->setModeration(false)
					->setActive(true)
					->setReplayId($message)
					->setBlock(false)
					->setBody($form->getData()['body'])
					->setQuote($form->getData()['quote'])
					;
			$em->persist($newMessage);
			$em->flush();

			$body = $this->renderView('ForumBundle:Forum:moderation.html.twig',['newMessage'=>$newMessage]);
			$mailer = $this->get('mailer');
			$message_swift = \Swift_Message::newInstance()
			->setSubject('Премодерация форума')
			->setFrom(array('nobody@vodohod.com'=>'Форум'))
			->setTo(array($this->getParameter('email_forum_moderator')))
			->setBcc(array('dkochetkov@vodohod.ru'))
			->setBody($body, 'text/html')
			;
			$mailer->send($message_swift);	
			
			$countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($message->getForumTheme()->getId());
			
			return $this->redirectToRoute('forum_theme',[
			'forum_id'=>$message->getForumTheme()->getForum()->getId(),
			'theme_id'=>$message->getForumTheme()->getId(),
			'p'=> ceil($countAnswers/20)
			]);	
			 
		}	
		return ['message'=>$message, 'form'=>$form->createView()];
	}
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/reply/{message_id}" , name="forum_reply")	 
     */	
	public function replyAction($message_id, Request $request)
	{
		$this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
		$em = $this->getDoctrine()->getManager();
		$message = $this->getDoctrine()->getRepository("ForumBundle:ForumMessage")->findOneById($message_id);
		$form = $this->createFormBuilder()
				->add('body', TextareaType::class,array('label' => 'Ваше сообщение'))
				->add('submit', SubmitType::class,array('label' => 'Отправить'))
				->getForm()
			;	
		$form->handleRequest($request);	
		
		if ($form->isSubmitted() && $form->isValid()) 
		{
			$newMessage = new ForumMessage();
			$newMessage
					->setForumTheme($message->getForumTheme())
					->setUser($this->getUser())
					->setDatetime(new \Datetime())
					->setModeration(false)
					->setActive(true)
					->setReplayId($message)
					->setBlock(false)
					->setBody($form->getData()['body'])
					->setQuote("")
					;
			$em->persist($newMessage);
			$em->flush();


			$body = $this->renderView('ForumBundle:Forum:moderation.html.twig',['newMessage'=>$newMessage]);
			$mailer = $this->get('mailer');
			$message_swift = \Swift_Message::newInstance()
			->setSubject('Премодерация форума')
			->setFrom(array('nobody@vodohod.com'=>'Форум'))
			->setTo(array($this->getParameter('email_forum_moderator')))
			->setBcc(array('dkochetkov@vodohod.ru'))
			->setBody($body, 'text/html')
			;
			$mailer->send($message_swift);					
			
			
			
			$countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($message->getForumTheme()->getId());
			
			return $this->redirectToRoute('forum_theme',[
			'forum_id'=>$message->getForumTheme()->getForum()->getId(),
			'theme_id'=>$message->getForumTheme()->getId(),
			'p'=> ceil($countAnswers/20)
			]);			 
		}	
		return ['message'=>$message, 'form'=>$form->createView()];
	}
	
	
	 /**
	 * @Template()	 
	 * @Route("/club/forums/{forum_id}/{theme_id}/{p}" , name="forum_theme")	 
     */
    public function themeAction($forum_id,$theme_id,$p = 1, Request $request)
	{
		
		
		$em = $this->getDoctrine()->getManager();
		$qb = $em->createQueryBuilder();
		$qb
				->select("ft,fm")
				->from("ForumBundle:ForumTheme","ft")
				->innerJoin("ft.forumMessages","fm" )
				->where("ft.id = ".$theme_id)
				->andWhere("ft.active = 1")
				->andWhere("ft.forum = ".$forum_id)
				->andWhere("ft.closed = 0")
				->andWhere("fm.active = 1")
				->andWhere("fm.block =  0")
				;
				
				//if(!$this->isGranted('ROLE_ADMIN_MODER'))
				$qb->andWhere("fm.moderation = 1");

				
		$qb 
				->orderBy("fm.datetime","ASC")
				->setFirstResult(($p-1) * 20)
				->setMaxResults(20)
				;
		$theme = $qb
				->getQuery()
				->getOneOrNullResult();
			;
			
		if ($theme == null) {
			throw $this->createNotFoundException("Страница не найдена.");
		}
		$countAnswers = $em->getRepository('ForumBundle:ForumTheme')->getCountAnswers($theme->getId());
		return ['forumTheme'=>$theme, 'p'=> $p ,  'count'=>ceil($countAnswers/20)];
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
				$forum->countThemes =  $em->getRepository('ForumBundle:Forum')->getCountThemes($forum->getId());
				$forum->countAnswers = $em->getRepository('ForumBundle:Forum')->getCountAnswers($forum->getId());
				$forum->lastMessage =  $em->getRepository('ForumBundle:Forum')->getLastMessage($forum->getId());
			}
		}
		return ['forumGroups'=>$forumGroups];
	}

	
}
