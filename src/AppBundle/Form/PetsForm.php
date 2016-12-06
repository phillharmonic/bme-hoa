<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PetsForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('name', 'text', array(
            'label'         =>  'Name'
        ));
        $builder->add('type', 'text', array(
            'label'         =>  'Type'
        ));
        $builder->add('color', 'text', array(
            'label'         =>  'Color'
        ));
        $builder->add('born', 'date', array(
            'label'         =>  'Born'
        ));
        $builder->add('breed', 'text', array(
            'label'         =>  'Breed'
        ));
        $builder->add('gender', 'text', array(
            'label'         =>  'Gender'
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
            'data_class' => 'MainBundle\Entity\Pets',
        ));
    }
    
    public function getName()
    {
        return 'pets';
    }
}
