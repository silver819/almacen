<?php

namespace Acme\StoreBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductoType extends AbstractType{
	public function getName(){
		return "formulario_producto";
	}

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		//-> setAction($this->generateUrl('ingreso_edit'))
		->setMethod('POST')
		->add('name')
		->add('price');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array('data_class'=>'Acme\StoreBundle\Document\Product'));
	}
}

?>