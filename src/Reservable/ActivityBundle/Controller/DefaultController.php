<?php

namespace Reservable\ActivityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ReservableActivityBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createActivityAction()
    {
    	return $this->render('ReservableActivityBundle:Default:index.html.twig', array('name' => 'Cristina'));
    }
}
