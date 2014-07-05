<?php

namespace Reservable\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reservable\ActivityBundle\Document\Activity;
use Reservable\ActivityBundle\Form\Type\ActivityType;
use Reservable\ActivityBundle\Document\Picture;
use Reservable\ActivityBundle\Form\Type\PictureType;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReservableActivityBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createActivityAction()
    {
		$activity = new Activity();
        $activity->setOwnerID($this->get('security.context')->getToken()->getUser()->getId());

		$form = $this->createForm(new ActivityType(), $activity);

    	return $this ->render('ReservableActivityBundle:newActivity:create_activity_form.html.twig', array('form'=>$form->CreateView()));
    }

    public function submitActivityAction(){
		$dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new ActivityType());
	    $form->bind($this->getRequest());

	    if ($form->isValid()) {
	        $registration = $form->getData();

	        $dm->persist($registration);
	        $dm->flush();

			return $this->redirect('activityRegistered');
	    }

	    return $this->render('ReservableActivityBundle:newActivity:create_activity_form.html.twig', array('form'=>$form->CreateView()));
	}

	public function activityRegisteredAction(){
		//return new Response('Actividad guardada.');
		return $this->render('ReservableActivityBundle:newActivity:activity_form_success.html.twig');
	}

    

	public function viewActivitiesAction(){
		$repository = $this->get('doctrine_mongodb')
	    ->getManager()
	    ->getRepository('ReservableActivityBundle:Activity');

		// The query
		$product = $repository->findBy(
    		array('ownerID' => $this->get('security.context')->getToken()->getUser()->getId())
    	);

		return $this->render('ReservableActivityBundle:Default:view_activities.html.twig', array('products'=>$product));
	}

    public function modifyActivitiesAction(){
        foreach($_POST as $key => $value){
            if($key == 'productID'){
                $id = $value;
            }

            if($key == 'newPrice' && !empty($value)){
                $price = $value;
            }
        }


        $dm      = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('ReservableActivityBundle:Activity')->find($id);

        if(!empty($price)) $product->setPrice($price);
        
        $dm->flush();

        // The query
        $repository = $this->get('doctrine_mongodb')
        ->getManager()
        ->getRepository('ReservableActivityBundle:Activity');
        $all = $repository->findBy(
            array('ownerID' => $this->get('security.context')->getToken()->getUser()->getId())
        );

        return $this->render('ReservableActivityBundle:Default:view_activities.html.twig', array('products'=>$all));
    }

	public function uploadFileAction()
    {
		$picture 		= new Picture();
		$pictureType 	= new PictureType();

		$form = $this->createForm($pictureType, $picture);

    	return $this ->render('ReservableActivityBundle:newPicture:upload_picture_form.html.twig', 
    		array('form'=>$form->CreateView()));
    }

    public function submitUploadFileAction()
    {
/*
$picture = new Picture();
        $form = $this -> createForm(new PictureType(), $picture);

        if($request->isMethod('POST'))
        {
            $form->bind($this->getRequest());
            if($form->isValid())
            {
                $picture->upload();
                $em = $this -> getDoctrine() -> getManager();
                $em->persist($picture);
                $em->flush();
 
             }else
            {
                $this->get('session')->getFlashBag()->add('fail', 'Fallo en el envío del formulario');
                return $this->redirect($this->generateUrl('acme_inicio_homepage'));
            }
        }

        return $this->render('AcmeStoreBundle:Default:img.html.twig', array('pictureform' => $form->createView()));
*/

    	$dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new PictureType());
	    $form->bind($this->getRequest());

	    if ($form->isValid()) {
	        $picture = $form->getData();

			$picture->upload();

	        $dm->persist($picture);
	        $dm->flush();

			return $this->redirect('picture-uploaded');
	    }

	    return $this->render('ReservableActivityBundle:newPicture:upload_picture_form.html.twig', 
	    	array('form'=>$form->CreateView()));
    }

    public function pictureUploadedAction()
    {
    	return $this->render('ReservableActivityBundle:newPicture:upload_picture_success.html.twig');
    }

}