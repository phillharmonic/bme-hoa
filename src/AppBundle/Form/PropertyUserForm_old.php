<?php

namespace MainBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyUserForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('user', 'entity', array(
            'required'      => false,
            'class'         =>  'MainBundle:User',
            'property'      =>  'usernames',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('u')
                    ->addOrderBy('u.lastname', 'ASC')
                    ->addOrderBy('u.firstname', 'ASC');
            },
            'label'         =>  'Homeowner',
            'placeholder'   =>  'Choose'
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
        ));
    }
    
    public function getName()
    {
        return 'propertyuser';
    }
    
}
