<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class GoalForm extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('action', ChoiceType::class, array(
                    'required' => true,
                    'placeholder'   => 'Choose an option',
                    'choices'  => array(
                        'Collect'   => 'Collect',
                        'Complete'  => 'Complete',
                        'Send'      => 'Send',
                        'Arrange'   => 'Arrange',
                        'Pass'   => 'Pass',
                        'Adopt'   => 'Adopt',
                        'Call'   => 'Call',
                        'Negotiate'   => 'Negotiate',
                        'Communicate'   => 'Communicate',
                        'Email'   => 'Email',
                        'Mail'   => 'Mail',
                        'Enroll'   => 'Enroll',
                    ),
                ))
                ->add('unitsGoal', IntegerType::class, array(
                    'label'     =>  'How Many?', 
                    'attr'      =>  array(
                        'Title' => 'Quanitfy your goal',
                        'placeholder'   => 'Quantify your goal',
                        'style' =>  "width: 160px;"
                        )
                ))
                
                ->add('units', TextType::class, array(
                    'label'     =>  'What?', 
                    'attr'      =>  array(
                        'Title' => 'What you are measuring ',
                        'placeholder'   => 'What you are measuring'
                        )
                ))
                
                ->add('completionGoalDate', DateType::class, array(
                    'widget'    =>  'single_text',
                    'label'     =>  'By', 
                    'required'  =>  false,
                    'attr'  => array('style' =>  "width: 115px;")
                ))
                ->add('submit', SubmitType::class, array())
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Goal'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'goal';
    }


}
