<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class DependentsForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('firstname', TextType::class, array(
            'label'         =>  'First Name'
        ));
        $builder->add('lastname', TextType::class, array(
            'label'         =>  'Last Name'
        ));
        $builder->add('mi', TextType::class, array(
            'label'         =>  'MI'            
        ));
        $builder->add('bday', DateType::class, array(
            'label'         =>  'Birthday ',
        ));
        $builder->add('gender', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Male'          => 'Male',
                'Female'        => 'Female',
            ),
//            'choices_as_values' => true,
        ));
        $builder->add('cellphone', TextType::class, array(
            'label'         =>  'Cell Phone'
        ));
        $builder->add('spouse', CheckboxType::class, array(
            'required'      => false,
        ));
        $builder->add('type', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
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
//            'choices_as_values' => true,
        ));
        
        $builder->add('photos', CollectionType::class, array(
            'entry_type'   => PhotoAltForm::class,
            'allow_add'    => true,
            'by_reference' => false,
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Dependents',
        ));
    }
    
    public function getName()
    {
        return 'dependents';
    }
}
