<?php

namespace AppBundle\Form;

use AppBundle\Entity\Complaint;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

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
                'Other - Complaint Not Listed'                  => 'Other - Complaint Not Listed',
            ),
        ));
        $builder->add('details', TextareaType::class, array(
            'attr'  =>  array(
                'style' =>  'height: 200px',
                'placeholder'   =>  'Provide a thourough account of your complaint.  Be explicit.'
            )
        ));
        $builder->add('defendent_name', TextType::class, array(
            'label'         =>  'Accused\'s name',
            'attr'  =>  array(
                'placeholder'   =>  'Who are you accusing?'
            )
        ));
        $builder->add('defendent_address', TextType::class, array(
            'label'         =>  'Accused\'s address',
            'attr'  =>  array(
                'placeholder'   =>  'Where do they live?'
            )
        ));
        $builder->add('reg_violated', TextareaType::class, array(
            'label'         =>  'Regulation in violation',
            'attr'  =>  array(
                'style' =>  'height: 150px',
                'placeholder'   =>  'Be sure the accused is in violation of a regulation before you complain.  Reference the Legal section from the menu above and document the regulation here.'
            )
        ));
        $builder->add('photos', CollectionType::class, array(
            'entry_type'   => PhotoForm::class,
            'allow_add'    => true,
            'by_reference' => false,
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
        
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Complaint::class,
        ));
    }
    
    public function getName()
    {
        return 'complaint';
    }
}
