<?php

namespace AppBundle\Form;

use AppBundle\Entity\Action;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ActionComplaintForm extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Action TYPE is set to 'PERMIT' on the prePersist event.
        // Action DATE_TAKEN is set to NOW() on the prePersist event.
        // Action TAKEN_BY is set on the prePersist event - this may be a redundant field.
        
        
        $builder->add('action', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                //  choices must contain key words APPROVED DENIED or PENDING
                //  because on the prePersist action the PERMIT entity is updated 
                //  based on these words as is is_resolved of this entity 
                'VERBAL WARNING - Given by Board Member in Person'        => 'VERBAL WARNING - Given by Board Member in Person',
                'WRITTEN NOTICE [1] - Documented Email or USPS if no email on file'    => 'WRITTEN NOTICE [1] - Documented Email or USPS if no email on file',
                'WRITTEN NOTICE [2] - Documented Email or USPS if no email on file'    => 'WRITTEN NOTICE [2] - Documented Email or USPS if no email on file',
                'WRITTEN NOTICE [3] - Documented Email or USPS if no email on file'    => 'WRITTEN NOTICE [3] - Documented Email or USPS if no email on file',
                'ASSESSMENT ISSUED [1] - For non-compliance'                => 'ASSESSMENT ISSUED [1] - For non-compliance',
                'ASSESSMENT ISSUED [2] - For non-compliance'  => 'ASSESSMENT ISSUED [2] - For non-compliance',
                'ASSESSMENT ISSUED [3] - For non-compliance'          => 'ASSESSMENT ISSUED [3] - For non-compliance',
                'SENT TO COLLECTIONS - problem not corrected, assessment(s) uncollected'       => 'SENT TO COLLECTIONS - problem not corrected, assessment(s) uncollected',
                'LIEN ISSUED - problem not corrected, assessment(3) uncollected'          => 'LIEN ISSUED - problem not corrected, assessment(3) uncollected',
                'FORECLOSURE INTENT - notice sent of intent to foreclose on home for non-compliance'           => 'FORECLOSURE INTENT - notice sent of intent to foreclose on home for non-compliance',
                'FORECLOSURE - legal proceedings initiated'        => 'FORECLOSURE - legal proceedings initiated',
                'SHERIFF SALE - date set for sheriff\'s sale'          => 'SHERIFF SALE - date set for sheriff\'s sale',
                'PROBLEM RESOLVED - by the HOA at the HOMEOWNERS EXPENSE'              => 'PROBLEM RESOLVED - by the HOA at the HOMEOWNERS EXPENSE',
                'PROBLEM RESOLVED - by the homeowner voluntarily'      => 'PROBLEM RESOLVED - by the homeowner voluntarily',
                'PROBLEM RESOLVED - all outstanding money\'s due the HOA have been collected & problem has been corrected'          => 'PROBLEM RESOLVED - all outstanding money\'s due the HOA have been collected & problem has been corrected',
                'OTHER - See details'          => 'OTHEr - See details',
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