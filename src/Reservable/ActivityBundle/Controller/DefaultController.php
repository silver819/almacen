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

            // Envio correo electronico test
            $mensaje = new \Swift_Message();

            $text  = '<h1>Nueva actividad registrada</h1><br/><br/>';
            $text .= '<strong>Nombre</strong>: ' . $registration->getName();
            $text .= '<br/><strong>Precio</strong>: ' . $registration->getPrice() . ' €';
            $text .= '<br/><br/><p><a href="http://almacen.dev/app_dev.php/view-instalations">Click aquí para ver sus instalaciones</a></p>';

            $userEmail = $this->get('security.context')->getToken()->getUser()->getEmail();;

            $mensaje->setContentType ('text/html')
                    ->setSubject ('Nueva instalación en Almacen.Dev')
                    ->setFrom('almacenpfcs@gmail.com')
                    ->setTo($userEmail)
                    ->setBody($text);
            
            $this->get('mailer')->send($mensaje);

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

        $imagesRepositoty = $this->get('doctrine_mongodb')
        ->getManager()
        ->getRepository('ReservableActivityBundle:Picture');

		// The query
		$product = $repository->findBy(
    		array('ownerID' => $this->get('security.context')->getToken()->getUser()->getId())
    	);

        foreach($product as $one){
            $image = $imagesRepositoty->findBy(array('activityID' => $one->getId()));

            foreach($image as $theImage){
                $arrayPictures[$one->getId()] = $theImage->getPicPath();
            }
        }

		return $this->render('ReservableActivityBundle:Default:view_activities.html.twig', array('products'=>$product, 'arrayPictures'=>$arrayPictures));
	}

    public function modifyActivitiesAction(){
        foreach($_POST as $key => $value){
            if($key == 'productID'){
                $id = $value;
            }
            else if($key == 'newPrice' && !empty($value) && is_numeric($value)){
                $price = $value;
            }
            else if($key == 'newName' && !empty($value) && is_string($value)){
                $name = $value;
            }
            else if($key == 'description' && !empty($value) && is_string($value)){
                $description = $value;
            }
            else if($key == 'address' && !empty($value) && is_string($value)){
                $address = $value;
            }
        }


        $dm      = $this->get('doctrine_mongodb')->getManager();
        $product = $dm->getRepository('ReservableActivityBundle:Activity')->find($id);

        if(!empty($price))          $product->setPrice($price);
        if(!empty($name))           $product->setName($name);
        if(!empty($description))    $product->setDescription($description);
        if(!empty($address))        $product->setAddress($address);
        
        $dm->flush();

        return $this->redirect('view-instalations');
    }

    public function deleteActivityAction(){
        return $this->redirect('view-instalations');
    }

	public function uploadFileAction()
    {
		$picture 		= new Picture();
        $picture->setActivityID('539d677622c0e7fd0d0ad377');
		$pictureType 	= new PictureType();

		$form = $this->createForm($pictureType, $picture);

    	return $this ->render('ReservableActivityBundle:newPicture:upload_picture_form.html.twig', 
    		array('form'=>$form->CreateView()));
    }

    public function submitUploadFileAction()
    {

    	$dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new PictureType());
	    $form->bind($this->getRequest());

	    if ($form->isValid()) {
	        $picture = $form->getData();

			$picture->upload();

	        $dm->persist($picture);
	        $dm->flush();

			//return $this->redirect('picture-uploaded');
            return $this->redirect('view-instalations');
	    }

	    return $this->render('ReservableActivityBundle:newPicture:upload_picture_form.html.twig', 
	    	array('form'=>$form->CreateView()));
    }

    public function pictureUploadedAction()
    {
    	return $this->render('ReservableActivityBundle:newPicture:upload_picture_success.html.twig');
    }

    public function calendarAction(){

        return $this->render('ReservableActivityBundle:calendar:calendar.html.twig',
            array('month'=>3, 'year'=>2014, 'item'=>1, 'admin'=>0));
    }

}