<?php

namespace BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class PageController extends Controller
{
	 /**
	 * @Template()
     */
    public function indexAction($url)
    {
		$repository = $this->getDoctrine()->getRepository('BaseBundle:Page');
		$page = $repository->findOneByFullUrl($url);
		if ($page == null) {
			throw $this->createNotFoundException("Страница $url не найдена.");
		}
		return ['page' => $page ];
    }
	

	
}
