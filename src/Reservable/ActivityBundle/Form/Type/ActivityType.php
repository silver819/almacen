<?php

namespace Reservable\ActivityBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Reservable\ActivityBundle\Document\Activity;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ActivityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name');
        $builder->add('price');
        $builder->add('description');
        $builder->add('typeRent', 'choice', array(
            'choices'   => array('hour' => 'hora', 'day' => 'día'),
            'required'  => true,
        ));
        $builder->add('ownerID', 'hidden');
        $builder->add('address');
        $builder->add('lat', 'hidden');
        $builder->add('long', 'hidden');
    }

    public function getName()
    {
        return 'activity';
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
	{
    	$resolver->setDefaults(array('data_class' => 'Reservable\ActivityBundle\Document\Activity'));
    }
}