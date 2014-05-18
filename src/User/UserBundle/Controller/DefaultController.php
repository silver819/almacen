<?php

namespace User\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use User\UserBundle\Document\User;
use User\UserBundle\Form\UserType;
use User\UserBundle\Form;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('UserUserBundle:Default:index.html.twig', array());
    }

    public function newUserAction()
	{
		$user = new User();

		$form = $this->createForm(new UserType(), $user, 
			array('action'=>$this->generateUrl('insertUser', array('id'=>$user->getId())), 
			      'method'=>'POST'));

	    return $this->render('UserUserBundle:Default:registerUserForm.html.twig', array('form' => $form->createView()));
	}

	public function insertUserAction()
	{
		$dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new USerType());

	    $form->bind($this->getRequest());

	    if ($form->isValid()) {
	        $registration = $form->getData();

	        $dm->persist($registration);
	        $dm->flush();

	        return $this->render('UserUserBundle:Default:index.html.twig', array('data' => 'Usuaro registrado'));
	    }

	    return $this->render('UserUserBundle:Default:registerUserForm.html.twig', array('form' => $form->createView()));
	}
}
