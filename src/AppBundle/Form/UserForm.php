<?php

namespace MainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bday', 'birthday', array(
            'label'         =>  'Birthday '
        ));
        $builder->add('cellphone', 'text', array(
            'label'         =>  'Cell Phone'
        ));
        $builder->add('email', 'text', array(
            'label'         =>  'Email'
        ));
        $builder->add('firstname', 'text', array(
            'label'         =>  'First Name'
        ));
        $builder->add('gender', 'choice', array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Male'          => 'Male',
                'Female'        => 'Female',
                'Transexual'    => 'Transexual',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('homephone', 'text', array(
            'label'         =>  'Home Phone'
        ));
        $builder->add('honorific', 'choice', array(
            'required' => false,
            'choices'   => array(
                'Mr.'       => 'Mr.',
                'Mss.'      => 'Mss',
                'Mrs.'      => 'Mrs.',
                'Ms.'       => 'Ms.',
                'Dr.'       => 'Dr.',
                'Esq.'      => 'Esq.',
                'Coach'     => 'Coach',
                'Officer'   => 'Officer',
                'Reverend'  => 'Reverend',
                'Father'    => 'Father',
                'Sister'    => 'Sister',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('lastname', 'text', array(
            'label'         =>  'Last Name'
        ));
        $builder->add('marital_status', 'choice', array(
            'label'         =>  'Marital Status',
            'required'      => false,
            'choices'       => array(
                'Single'    => 'Single',
                'Married'   => 'Married',
                'Divorced'  => 'Divorced',
                'Widowed'   => 'Widowed',
                'Separated' => 'Separated',
                'Living in Sin'      => 'Living in Sin',
                'Cohabitate'     => 'Cohabitate',
                'Live with gay partner'   => 'Live with gay partner',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('mi', 'text', array(
            'label'         =>  'MI'
        ));
        $builder->add('occupation', 'text', array(
            'label'         =>  'Occupation'
        ));
        $builder->add('occupy_date', 'date', array(
            'years' => range(date('Y') -15, date('Y')),
            'label'         =>  'Occupy Date '
        ));
        $builder->add('housenumber', 'integer', array(
            'label'         =>  'House Number'
        ));
        $builder->add('street', 'choice', array(
            'label'         =>  'Street',
            'required'      => true,
            'placeholder'   => 'Choose an option',
            'choices'       => array(
                'Brandy Mill Drive'    => 'Brandy Mill Drive',
                'Spring Flower Way'   => 'Spring Flower Way',
                'Spring Brook Court'  => 'Spring Brook Court',
                'Cosmos Lane'   => 'Cosmos Lane',
                'Lavender Hill Drive' => 'Lavender Hill Drive',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('username', 'text', array(
            'label'         =>  'Username'
        ));
//        $builder->add('vacate_date', 'date', array(
//            'years' => range(date('Y') -15, date('Y')),
//            'label'         =>  'Vacate Date '
//        ));
        
        $builder->add('photos', 'collection', array(
            'type' => new PhotoForm(),
            'allow_add'    => true,
            'by_reference' => false,
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MainBundle\Entity\User',
        ));
    }
    
    public function getName()
    {
        return 'user';
    }
}
