<?php

namespace AppBundle\Form;

use AppBundle\Entity\Agenda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgendaForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {               
        $builder->add('year', DateType::class, array(
        ));
        $builder->add('agenda_path', TextType::class, array(
            'label'         =>  'Path to Google Docs Agenda:'
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Agenda::class,
        ));
    }
    
    public function getName()
    {
        return 'action';
    }
}