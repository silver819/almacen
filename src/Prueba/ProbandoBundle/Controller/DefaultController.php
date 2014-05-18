<?php

namespace Prueba\ProbandoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('PruebaProbandoBundle:Default:index.html.twig', array('name' => $name));
    }

    public function enviarMailAction()
    {
	$mensaje = new \Swift_Message();

	$mensaje->setContentType ('text/plain')
	->setSubject ('Saludos desde el Curso de Symfony')
	->setFrom('silver819@gmail.com')
	->setTo('silver819@gmail.com')
	->setBody('Este es un mensaje enviado desde Symfony');

	$this->get('mailer')->send($mensaje);

	$respuesta = new Response('Enviando correo ');

	return $respuesta;

    }
}
