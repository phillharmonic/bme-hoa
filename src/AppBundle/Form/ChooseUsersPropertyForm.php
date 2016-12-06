<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ChooseUsersPropertyForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        //need a widget that lets the user select from a list of his properties
        
        $builder->add('property', EntityType::class, array(
            'required'      => true,
            'multiple'      => false,
            'class'         =>  'AppBundle:User',
            'choice_label'  =>  'usernames',
            'query_builder' =>   $user->getProperty(),
            
//            function (EntityRepository $er) {
//                return $er->createQueryBuilder('u')
//                    ->addOrderBy('u.lastname', 'ASC')
//                    ->addOrderBy('u.firstname', 'ASC');
//            },
            'label'         =>  'Choose a Property',
            'placeholder'   =>  'Choose'
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\User',
        ));
    }
    
    public function getName()
    {
        return 'user';
    }
}
