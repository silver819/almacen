<?php

namespace Acme\StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// src/Acme/StoreBundle/Controller/DefaultController.php
use Acme\StoreBundle\Document\Product;
use Acme\StoreBundle\Form\ProductoType;
use Acme\StoreBundle\Form;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('AcmeStoreBundle:Default:index.html.twig', array('name' => $name));
    }

    public function createAction()
	{
	    $product = new Product();
	    $product->setName('A Foo Bar');
	    $product->setPrice('19.99');

	    $dm = $this->get('doctrine_mongodb')->getManager();
	    $dm->persist($product);
	    $dm->flush();

	    return new Response('Created product id '.$product->getId());
	}

	public function showAction($id)
	{
	$repository = $this->get('doctrine_mongodb')
	    ->getManager()
	    ->getRepository('AcmeStoreBundle:Product');

	// query by the primary key (usually "id")
	$product = $repository->find($id);

    /*$product = $this->get('doctrine_mongodb')
        ->getRepository('AcmeStoreBundle:Product')
        ->find($id);

    if (!$product) {
        throw $this->createNotFoundException('No product found for id '.$id);
    }*/

    return $this->render('AcmeStoreBundle:Default:index.html.twig', array('id' => $product->getName()));
	}

	public function updateAction($id)
	{
	    $dm = $this->get('doctrine_mongodb')->getManager();
	    $product = $dm->getRepository('AcmeStoreBundle:Product')->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException('No product found for id '.$id);
	    }

	    $product->setName('New product name!');
	    $dm->flush();

	    return $this->render('AcmeStoreBundle:Default:index.html.twig', array('id' => "Nombre actualizado"));
	}

	public function deleteAction($id)
	{
	    $dm = $this->get('doctrine_mongodb')->getManager();
	    $product = $dm->getRepository('AcmeStoreBundle:Product')->find($id);

	    if (!$product) {
	        throw $this->createNotFoundException('No product found for id '.$id);
	    }
	    
		$dm->remove($product);
		$dm->flush();

		return $this->render('AcmeStoreBundle:Default:index.html.twig', array('id' => "producto eliminado."));
	}

	public function createProductFormAction(){
		$producto = new Product();
		$form = $this->createForm(new ProductoType(), $producto);
		return $this ->render('AcmeStoreBundle:Default:create_product_form.html.twig', array('form'=>$form->CreateView()));
	}

	public function submitFormProductAction(){
		$dm = $this->get('doctrine_mongodb')->getManager();

	    $form = $this->createForm(new ProductoType());

	    $form->bind($this->getRequest());

	    if ($form->isValid()) {
	        $registration = $form->getData();

	        $dm->persist($registration);
	        $dm->flush();

	        return $this->redirect('productCreated');
	    }

	    return $this->render('AcmeStoreBundle:Default:create_product_form.html.twig', array('form' => $form->createView()));
	}

	public function productCreatedOKAction(){
		return new Response('Producto guardado.');
	}
}