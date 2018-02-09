<?php

namespace AdminBundle\Controller;

use BaseBundle\Entity\MotorshipRoomImage;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Motorshiproomimage controller.
 *
 * @Route("motorshiproomimage")
 */
class MotorshipRoomImageController extends Controller
{
    /**
     * @Route("/", name="motorshiproomimage_ships")
     * @Method("GET")
     */
    public function shipsAction()
    {
        $em = $this->getDoctrine()->getManager();
        $em_cruise = $this->getDoctrine()->getManager('cruise');

		$query = $em_cruise->getRepository('CruiseBundle:Motorship')->createQueryBuilder('s')
			->andWhere('s.motorshipType > 0')
			->andWhere('s.active = 1') 
			->orderBy('s.name', 'ASC')
			->getQuery()
			;		
		$ships = $query->getResult();
        return $this->render('motorshiproomimage/ships.html.twig', array(
            'ships' => $ships,
        ));
    }



    /**
     * Lists all motorshipRoomImage entities.
     *
     * @Route("/ship/{ship_code}", name="motorshiproomimage_ship")
     * @Method("GET")
     */
    public function indexAction($ship_code)
    {
        $em = $this->getDoctrine()->getManager();
		$em_cruise = $this->getDoctrine()->getManager('cruise');
		
		$ship = $em_cruise->getRepository('CruiseBundle:Motorship')->findOneByCode($ship_code);
		
		
		$q = "SELECT p
			FROM CruiseBundle:Price p
			LEFT JOIN p.roomType rt
			WHERE p.motorship = ".$ship->getId()."
			AND p.active = 1
			AND p.additional = 0
			AND p.cruise IS NULL 
			
			
			GROUP BY p.roomType,p.deck
			
			ORDER BY p.deck DESC, rt.priority ASC, p.roomPlacing ASC
		";
		$query = $em_cruise->createQuery($q);
		$prices = $query->getResult();		
		
        $motorshipRoomImages = $em->getRepository('BaseBundle:MotorshipRoomImage')->findByMotorship($ship->getId());

        return $this->render('motorshiproomimage/ship.html.twig', array(
            'prices' => $prices,
			'ship'   => $ship,
			'motorshipRoomImages' =>$motorshipRoomImages
        ));
    }

    /**
     * Creates a new motorshipRoomImage entity.
     *
     * @Route("/new/{ship_code}", name="motorshiproomimage_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request,$ship_code)
    {
		$em_cruise = $this->getDoctrine()->getManager('cruise');
		
		$ship = $em_cruise->getRepository('CruiseBundle:Motorship')->findOneByCode($ship_code);

		$motorshipRoomImage = new Motorshiproomimage();
		
		$motorshipRoomImage->setDeck($request->query->get('deck'));
		$motorshipRoomImage->setRoomType($request->query->get('roomType'));
		$motorshipRoomImage->setRoomType($request->query->get('roomType'));
		$motorshipRoomImage->setSort(500);
		$motorshipRoomImage->setMotorship($ship->getId());
		
		
        $form = $this->createForm('BaseBundle\Form\MotorshipRoomImageType', $motorshipRoomImage);
        $form->handleRequest($request);
		
		$images = $request->request->get("image");


        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();



			if ($images)
			{
				foreach($images as $id => $title)
				{
					$image = $em->getRepository('BaseBundle:Image')->findOneById($id);
					if($image == null) continue;
					$image->setTitle($title);
					$motorshipRoomImage->addFile($image);
					$em->persist($image);
				}	
			}
			
            $em->persist($motorshipRoomImage);
            $em->flush();

            return $this->redirectToRoute('motorshiproomimage_ship', array('ship_code' => $ship_code));
        }

        return $this->render('motorshiproomimage/new.html.twig', array(
            'motorshipRoomImage' => $motorshipRoomImage,
            'form' => $form->createView(),
			'ship' => $ship
        ));
    }

    /**
     * Finds and displays a motorshipRoomImage entity.
     *
     * @Route("/{id}", name="motorshiproomimage_show")
     * @Method("GET")
     */
    public function showAction(MotorshipRoomImage $motorshipRoomImage)
    {
        $deleteForm = $this->createDeleteForm($motorshipRoomImage);

        return $this->render('motorshiproomimage/show.html.twig', array(
            'motorshipRoomImage' => $motorshipRoomImage,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing motorshipRoomImage entity.
     *
     * @Route("/{id}/edit", name="motorshiproomimage_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MotorshipRoomImage $motorshipRoomImage)
    {
		$em_cruise = $this->getDoctrine()->getManager('cruise');
		
		$ship = $em_cruise->getRepository('CruiseBundle:Motorship')->findOneById($motorshipRoomImage->getMotorship());


		$deleteForm = $this->createDeleteForm($motorshipRoomImage);
        $editForm = $this->createForm('BaseBundle\Form\MotorshipRoomImageType', $motorshipRoomImage);

		$images = $request->request->get("image");
		$imagesSort = $request->request->get("image-sort");		
		
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
			
			$em =  $this->getDoctrine()->getManager();
			
			if ($images)
			{
				$motorshipRoomImage->removeAllFile();
				
				foreach($images as $id => $title)
				{
					$image = $em->getRepository('BaseBundle:Image')->findOneById($id);
					if($image == null) continue;
					$image->setTitle($title);
					$image->setSort($imagesSort[$id]);
					$motorshipRoomImage->addFile($image);
					$em->persist($image);
				}	
			}			
			
			
           $em->flush();

            return $this->redirectToRoute('motorshiproomimage_ship', array('ship_code' => $ship->getCode()));
        }

        return $this->render('motorshiproomimage/edit.html.twig', array(
            'motorshipRoomImage' => $motorshipRoomImage,
            'ship' => $ship,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a motorshipRoomImage entity.
     *
     * @Route("/{id}", name="motorshiproomimage_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MotorshipRoomImage $motorshipRoomImage)
    {
		$em_cruise = $this->getDoctrine()->getManager('cruise');
		$ship = $em_cruise->getRepository('CruiseBundle:Motorship')->findOneById($motorshipRoomImage->getMotorship());
		
        $form = $this->createDeleteForm($motorshipRoomImage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($motorshipRoomImage);
            $em->flush();
        }

        return $this->redirectToRoute('motorshiproomimage_ship',['ship_code'=>$ship->getCode()]);
    }

    /**
     * Creates a form to delete a motorshipRoomImage entity.
     *
     * @param MotorshipRoomImage $motorshipRoomImage The motorshipRoomImage entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MotorshipRoomImage $motorshipRoomImage)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('motorshiproomimage_delete', array('id' => $motorshipRoomImage->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
