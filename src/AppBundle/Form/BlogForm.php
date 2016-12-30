<?php

namespace AppBundle\Form;

use AppBundle\Entity\Blog;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class BlogForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('title', TextType::class, array(
            'label'         =>  'Title'
        ));
        $builder->add('blog', TextareaType::class, array(
            'label'         =>  'Blog Post'
        ));
        $builder->add('tags', TextareaType::class, array(
            'label'         =>  'Tags (separate each word with a comma)'
        ));
        $builder->add('image', FileType::class, array(
            'label'         =>  'Upload Photo'
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Blog::class,
        ));
    }
    
    public function getName()
    {
        return 'permit';
    }
}
