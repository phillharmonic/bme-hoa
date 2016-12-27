<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Form\PhotoForm;

class TermForm extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('start_date', DateType::class, array(
            'years' => range(date('Y') -15, date('Y')),
        ));
        $builder->add('end_date', DateType::class, array(
            'years' => range(date('Y') -15, date('Y')),
        ));
        $builder->add('trustee_position', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'President'             => 'President',
                'Secretary'             => 'Secretary',
                'Treasurer'             => 'Treasurer',
                'Vice President'        => 'Vice President',
                'Committee Chairman'    => 'Committee Chairman'
            ),
        ));
        $builder->add('aboutme', TextareaType::class, array(
            'attr' => array('style' => 'width: 50px')
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
            'data_class' => 'AppBundle\Entity\Term',
        ));
    }
    
    public function getName()
    {
        return 'term';
    }
}
