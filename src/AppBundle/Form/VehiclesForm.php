<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiclesForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('color', 'text', array(
            'label'         =>  'Color'
        ));
        $builder->add('year', 'integer', array(
            'label'         =>  'Year'
        ));
        $builder->add('make', 'text', array(
            'label'         =>  'Make'
        ));
        $builder->add('model', 'text', array(
            'label'         =>  'Model'
        ));
        $builder->add('photos', 'collection', array(
            'type' => new PhotoForm(),
            'allow_add'    => true,
            'by_reference' => false,
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\Vehicles',
        ));
    }
    
    public function getName()
    {
        return 'vehicles';
    }
}
