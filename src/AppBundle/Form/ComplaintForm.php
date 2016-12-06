<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ComplaintForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
//        $builder->add('user', 'text', array(
//            'label'         =>  'Name'
//        ));
        $builder->add('type', TextType::class, array(
            'label'         =>  'Type'
        ));
        $builder->add('details', TextType::class, array(
            'label'         =>  'Details'
        ));
//        $builder->add('born', 'date', array(
//            'label'         =>  'Born'
//        ));
//        $builder->add('breed', 'text', array(
//            'label'         =>  'Breed'
//        ));
//        $builder->add('gender', 'text', array(
//            'label'         =>  'Gender'
//        ));
//        $builder->add('photos', 'collection', array(
//            'type' => new PhotoForm(),
//            'allow_add'    => true,
//            'by_reference' => false,
//        ));
        
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
