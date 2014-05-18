<?php

namespace User\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType{
	public function getName(){
		return "registerUserForm";
	}

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
		->add('name', 'text', array(
			'label'				=> 'Nombre'))
		->add('surname', 'text', array(
			'label'				=> 'Apellidos'))
		->add('email', 'repeated', array(
		    'type'				=> 'email',
		    'invalid_message'	=> 'Los emails deben coincidir',
		    'options' 			=> array('attr' => array('class' => 'email')),
		    'required' 			=> true,
		    'first_options'  	=> array('label' => 'Email'),
		    'second_options' 	=> array('label' => 'Repite email')))
		->add('password', 'repeated', array(
		    'type' 				=> 'password',
		    'invalid_message' 	=> 'Las contraseñas deben coincidir',
		    'options' 			=> array('attr' => array('class' => 'password-field')),
		    'required' 			=> true,
		    'first_options'  	=> array('label' => 'Contraseña'),
		    'second_options' 	=> array('label' => 'Repite contraseña')))
		->add('Registrar', 'submit');
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver){
		$resolver->setDefaults(array('data_class'=>'User\UserBundle\Document\User'));
	}
}

?>