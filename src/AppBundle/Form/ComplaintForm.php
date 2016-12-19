<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ComplaintForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('type', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Complaint Against Homeowner '                  => 'Complaint Against Homeowner',
                'Complaint Agaisnt Board action/non-action '    => 'Complaint Agaisnt Board action/non-action',
                'Complaint Against Board Member'                => 'Complaint Against Board Member',
                'Complaint Against Contractor'                  => 'Complaint Against Contractor',
                'Complaint Against Regulation(s)'               => 'Complaint Against Regulation(s)',
            ),
        ));
        $builder->add('details', TextareaType::class, array(
//            'label'         =>  'Type'
        ));
        $builder->add('defendent_name', TextType::class, array(
            'label'         =>  'Accused\'s name'
        ));
        $builder->add('defendent_address', TextType::class, array(
            'label'         =>  'Accused\'s address'   
        ));
        $builder->add('reg_violated', TextareaType::class, array(
            'label'         =>  'Regulation in violation'
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Complaint',
        ));
    }
    
    public function getName()
    {
        return 'complaint';
    }
}
