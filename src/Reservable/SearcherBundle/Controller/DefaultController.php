<?php

namespace Reservable\SearcherBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function resultsAction()
    {
    	foreach($_POST as $key => $value){
    		if($key == 'name'){
    			$query[$key] = new \MongoRegex("/$value/i");
    		}
    	}

    	$repository = $this->get('doctrine_mongodb')
    				->getManager()
    				->getRepository('ReservableActivityBundle:Activity');

    	$results = $repository->findBy($query);

        return $this->render('ReservableSearcherBundle:Default:index.html.twig', array('results' => $results));
    }
}
