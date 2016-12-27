<?php

namespace AppBundle\Form;

use AppBundle\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActionForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Action TYPE is set to 'PERMIT' on the prePersist event.
        // Action DATE_TAKEN is set to NOW() on the prePersist event.
        // Action TAKEN_BY is set on the prePersist event - this may be a redundant field.
        
        
        $builder->add('action', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                //  choices must contain the key words APPROVED DENIED or PENDING
                //  because on the prePersist action the PERMIT entity is updated 
                //  based on these words as is is_resolved of this entity 
                'APPROVED - Unanimous Board Opinion'        => 'APPROVED - Unanimous Board Opinion',
                'APPROVED - Split Board Opinion'            => 'APPROVED - Split Board Opinion',
                'APPROVED - Management Company Decision'    => 'APPROVED - Management Company Decision',
                'APPROVED - Attorney Decision'              => 'APPROVED - Attorney Decision',
                'APPROVED - Other reason (see details for further info)'     => 'APPROVED - Other reason (see details for further info)',
                'DENIED - Attorney Decision'                => 'DENIED - Attorney Decision',
                'DENIED - Regulations Specifically Forbid'  => 'DENIED - Regulations Specifically Forbid',
                'DENIED - Unanimous Board Opinion'          => 'DENIED - Unanimous Board Opinion',
                'DENIED - Split Board Opinion'              => 'DENIED - Split Board Opinion',
                'DENIED - Management Company Decision'      => 'DENIED - Management Company Decision',
                'DENIED - Other reason (see details for further info)'       => 'DENIED - Other reason (see details for further info)',
                'PENDING - Seeking input from Management company'          => 'PENDING - Seeking input from Management company',
                'PENDING - Seeking legal counsel'           => 'PENDING - Seeking legal counsel',
                'PENDING - Full Board has not voted'        => 'PENDING - Full Board has not voted',
                'PENDING - No Board members have voted'          => 'PENDING - No Board members have voted',
                'PENDING - A desicion has been postponed until the Board meets'          => 'PENDING - A desicion has been postponed until the Board meets',
                'PENDING - Other reason (see details for further info)'          => 'PENDING - Other reason (see details for further info)',
            ),
        ));
        $builder->add('description', TextareaType::class, array(
            'label'         =>  'Please describe in detail the action taken and why:'
        ));
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Action::class,
        ));
    }
    
    public function getName()
    {
        return 'action';
    }
}