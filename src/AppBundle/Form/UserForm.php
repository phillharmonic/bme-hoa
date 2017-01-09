<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\PhotoForm;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('bday', BirthdayType::class, array(
            'label'         =>  'Birthday '
        ));
        $builder->add('cellphone', TextType::class, array(
            'label'         =>  'Cell Phone'
        ));
        $builder->add('email', TextType::class, array(
            'label'         =>  'Email'
        ));
        $builder->add('firstname', TextType::class, array(
            'label'         =>  'First Name'
        ));
        $builder->add('gender', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Male'          => 'Male',
                'Female'        => 'Female',
                'Transexual'    => 'Transexual',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('homephone', TextType::class, array(
            'label'         =>  'Home Phone'
        ));
        $builder->add('honorific', ChoiceType::class, array(
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
        $builder->add('lastname', TextType::class, array(
            'label'         =>  'Last Name'
        ));
        $builder->add('marital_status', ChoiceType::class, array(
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
        $builder->add('race', ChoiceType::class, array(
            'label'         =>  'Race - optional',
            'required'      => false,
            'choices'       => array(
                'White'    => 'White',
                'Black or African American'   => 'Black or African American',
                'Hispanic or Latino'    => 'Hispanic or Latino',
                'Asian'   => 'Asian',
                'American Indian or Alaska Native'  => 'American Indian or Alaska Native',
                'Hawaiian Native & Pacific Islander' => 'Hawaiian Native & Pacific Islander.',
                'Some other'      => 'Some other',
                '2+ races'     => '2+ races',
            ),
            'choices_as_values' => true,
        ));
        $builder->add('mi', TextType::class, array(
            'label'         =>  'MI'
        ));
        $builder->add('occupation', TextType::class, array(
            'label'         =>  'Occupation'
        ));  
        $builder->add('occupation_public', CheckboxType::class, array(
            'label'         =>  'Occupation & Employer public',
            'required'      => false,
        ));  
        $builder->add('occupation_protected', CheckboxType::class, array(
            'label'         =>  'Occupation & Employer protected',
            'required'      => false,
        )); 
        $builder->add('employer', TextType::class, array(
            'required'      => false,
        ));        
        $builder->add('facebook', TextType::class, array(
            'required'      => false,
        ));  
        $builder->add('twitter', TextType::class, array(
            'required'      => false,
        ));  
        $builder->add('google', TextType::class, array(
            'required'      => false,
        ));  
        $builder->add('linkedin', TextType::class, array(
            'required'      => false,
        ));  
        $builder->add('bio', TextareaType::class, array(
            'label'         =>  'Bio - A Family Summary'
        )); 
        $builder->add('bio_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('bio_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('bday_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('bday_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('age_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('age_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('facebook_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('facebook_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('twitter_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('twitter_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('google_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('google_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('linkedin_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('linkedin_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('cellphone_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('cellphone_protected', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('homephone_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('homephone_protected', CheckboxType::class, array(
            'required'      => false,
        ));   
        $builder->add('email_public', CheckboxType::class, array(
            'required'      => false,
        ));  
        $builder->add('email_protected', CheckboxType::class, array(
            'required'      => false,
        )); 
        $builder->add('occupy_date', DateType::class, array(
            'years' => range(date('Y') -15, date('Y')),
            'label'         =>  'Occupy Date '
        ));
        $builder->add('housenumber', IntegerType::class, array(
            'label'         =>  'House Number'
        ));
        $builder->add('street', ChoiceType::class, array(
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
        $builder->add('username', TextType::class, array(
            'label'         =>  'Username'
        ));
//        $builder->add('vacate_date', 'date', array(
//            'years' => range(date('Y') -15, date('Y')),
//            'label'         =>  'Vacate Date '
//        ));
        
        $builder->add('photos', CollectionType::class, array(
//            'type' => new PhotoForm(),
            'entry_type'   => PhotoForm::class,
            'allow_add'    => true,
            'by_reference' => false,
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }
    
    public function getName()
    {
        return 'user';
    }
}
