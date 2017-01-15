<?php

namespace AppBundle\Form;

use AppBundle\Entity\Permit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class PermitForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('type', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Shed - Addition/Modification'          => 'Shed - Addition/Modification',
                'Deck - Addition/Modification'          => 'Deck - Addition/Modification',
                'Fence - Addition/Modification'         => 'Fence - Addition/Modification',
                'House Color Modification'              => 'House Color Modification',
                'Pool Installation'                     => 'Pool Installation',
                'Landscaping - Addition/Modification'   => 'Landscaping - Addition/Modification',
                'Driveway - Addition/Modification'      => 'Driveway - Addition/Modification',
                'Exterior Home Addition'                => 'Exterior Home Addition',
                'Misc. Exterior Modification'           => 'Misc. Exterior Modification',
            ),
        ));
        $builder->add('description', TextareaType::class, array(
            'label'         =>  'Details - BE EXPLICIT',
            'attr'  =>  array(
                'style' => "height: 150px;"
            )
        ));
        $builder->add('location', TextType::class, array(
            'label'         =>  'Location - BE EXPLCIT'
        ));
        $builder->add('drawings', FileType::class, array(
            'label' => 'Drawings & Pictures (PDF file)'
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Permit::class,
        ));
    }
    
    public function getName()
    {
        return 'permit';
    }
}
