<?php

namespace UserNew\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', 'text', array(
            'label'             => 'Nombre:'))
        ->add('surname', 'text', array(
            'label'             => 'Apellidos:'));
        parent::buildForm($builder, $options);
    }

    public function getName()
    {
        return 'user_new_user_registration';
    }
}