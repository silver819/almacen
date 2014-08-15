<?php

namespace UserNew\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
		$categories['Pistas'] 		= array('Futbol', 'Baloncesto', 'Tenis', 'Padel');
		$categories['Inmuebles']	= array('Celebraciones', 'Estancia');

        return $this->render('::base.html.twig', array('categories' => $categories));
    }

    public function adminAction()
    {
        return $this->render('UserNewUserBundle:Default:index.html.twig', array());
    }
}
