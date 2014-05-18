<?php

namespace Acme\AccountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\AccountBundle\Form\Type as RegistrationType;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeAccountBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createAction()
	{
	    $dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new RegistrationType(), new Registration());

	    $form->bindRequest($this->getRequest());

	    if ($form->isValid()) {
	        $registration = $form->getData();

	        $dm->persist($registration->getUser());
	        $dm->flush();

	        //return $this->redirect(...);
	    }

	    return $this->render('AcmeAccountBundle:Account:register.html.twig', array('form' => $form->createView()));
	}
}
