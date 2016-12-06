<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AccountForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('balance', IntegerType::class, array(
        ));
        
        $builder->add('users', EntityType::class, array(
            'required'      => false,
            'multiple'      => true,
            'class'         =>  'AppBundle:User',
            'choice_label'  =>  'usernames',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->addOrderBy('u.lastname', 'ASC')
                    ->addOrderBy('u.firstname', 'ASC');
            },
            'label'         =>  'Homeowner(s)',
            'placeholder'   =>  'Choose'
        ));
            
        $builder->add('property', EntityType::class, array(
            'required'      => false,
            'multiple'      => true,
            'class'         => 'AppBundle:Property',
            'choice_label'  => 'id',
            //function(Property $prop){return $prop->getHouseNumber().' '.$prop->getStreet();},
            // function(EntityRepository $er){return $er->getDisplayName();},
            //function(Property $prop){return $prop->getHouseNumber().' '.$prop->getStreet();},
//            function (EntityRepository $er) {return $er->createQueryBuilder('p')
//                    ->select('p.house_number');},
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('p')
                    ->addOrderBy('p.street', 'ASC')
                    ->addOrderBy('p.house_number', 'ASC');
            },
            'label'         =>  'Property',
            'placeholder'   =>  'Choose'
        ));
            
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Account',
        ));
    }
    
    public function getName()
    {
        return 'account';
    }
}
