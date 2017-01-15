<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ContactForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('name', TextType::class, array(
            'required' => true,
        ));
        $builder->add('email', EmailType::class, array(
            'required' => true,
        ));
        $builder->add('subject', TextType::class, array(
            'required' => false,
        ));
        $builder->add('body', TextareaType::class, array(
            'attr' => array('style' => 'height: 200px')
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Enquiry',
        ));
    }
    
    public function getName()
    {
        return 'contact';
    }
}
