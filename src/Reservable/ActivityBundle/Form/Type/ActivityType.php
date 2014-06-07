<?php
// src/Acme/TaskBundle/Form/Type/TaskType.php
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