<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DependentsForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', 'text', array(
            'label'         =>  'First Name'
        ));
        $builder->add('lastname', 'text', array(
            'label'         =>  'Last Name'
        ));
        $builder->add('mi', 'text', array(
            'label'         =>  'MI'            
        ));
        $builder->add('bday', 'birthday', array(
            'label'         =>  'Birthday ',
        ));
        $builder->add('gender', 'choice', array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Male'          => 'Male',
                'Female'        => 'Female',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('cellphone', 'text', array(
            'label'         =>  'Cell Phone'
        ));
        $builder->add('spouse', 'checkbox', array(
            'required'      => false,
        ));
        $builder->add('type', 'choice', array(
            'required' => true,
            'choices'   => array(
                'Wife'          => 'Wife',
                'Husband'       => 'Husband',
                'Son'           => 'Son',
                'Daughter'      => 'Daughter',
                'Step-son'      => 'Step-son',
                'Step-daughter' => 'Step-daughter',
                'Mother'        => 'Mother',
                'Father'        => 'Father',
                'Mother-in-law' => 'Mother-in-law',
                'Father-in-law' => 'Father-in-law',
                'Partner'       => 'Partner',
                'Relative'      => 'Relative',
            ),
            'choices_as_values' => true,
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
            'data_class' => 'MainBundle\Entity\Dependents',
        ));
    }
    
    public function getName()
    {
        return 'dependents';
    }
}
