<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class PhotoForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class, array(
            'attr'  =>  array(
                'placeholder'   =>  'Give your photo a name'
            )
        )); 
        $builder->add('description', TextareaType::class, array(
            'attr'  =>  array(
                'placeholder'   =>  'Please provide a description of the photo you are providing'
            )
        )); 
        $builder->add('path', TextareaType::class, array(
            'attr'  =>  array(
                'placeholder'   =>  'Requires a URL from a published photo on the internet. Hint: right click an image and \'Copy Image Addess\' and paste results here.'
            )
        )); 
        $builder->add('public', CheckboxType::class, array(
            'required'      => false,));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Photos',
        ));
    }
    
    public function getName()
    {
        return 'photo';
    }
    
}
