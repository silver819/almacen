<?php

namespace UserNew\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('::base.html.twig', array());
    }

    public function adminAction()
    {
        return $this->render('UserNewUserBundle:Default:index.html.twig', array());
    }
}
