<?php

namespace AppBundle\Form;

use AppBundle\Entity\Agenda;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AgendaForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {               
        $builder->add('year', IntegerType::class, array(
            'label' =>  'Year:',
            'attr'  => array(
                'placeholder'   => 'Must be unique. Each year may only have one Agenda.'
            )
        ));
        $builder->add('agenda_path', TextType::class, array(
            'label'         =>  'Path:',
            'attr'  => array(
                'placeholder'   => 'Publish a Google Doc to the web using the LINK option.'
            )
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
        return 'agenda';
    }
}