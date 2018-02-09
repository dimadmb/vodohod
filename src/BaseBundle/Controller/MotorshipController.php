<?php

namespace BaseBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class MotorshipController extends Controller
{
	public function getRoomImagesAction()
	{
		return new Response("");//$this->render('BaseBundle:Motorship:getRoomImages.html.twig');
	}
	
	
}
