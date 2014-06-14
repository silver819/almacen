<?php

namespace Reservable\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Reservable\ActivityBundle\Document\Activity;
use Reservable\ActivityBundle\Form\Type\ActivityType;
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

		// query by the primary key (usually "id")
		$product = $repository->find('5392d71322c0e78728c33045');
		$product = '';

		return $this->render('ReservableActivityBundle:Default:view_activities.html.twig', array('products'=>$product));
	}
}