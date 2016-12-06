<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AdminUserForm extends AbstractType {
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles', ChoiceType::class, array(
            'required'      => true,
            'multiple'      => true,
            'choices'  => array(
                'ROLE_SUPER_ADMIN'  => 'ROLE_SUPER_ADMIN',
                'ROLE_ADMIN'        => 'ROLE_ADMIN',
                'ROLE_ACCOUNTANT'   => 'ROLE_ACCOUNTANT',
                'ROLE_TRUSTEE'      => 'ROLE_TRUSTEE',
                'ROLE_MODERATOR'    => 'ROLE_MODERATOR',
                'ROLE_HOMEOWNER'    => 'ROLE_HOMEOWNER',
                'ROLE_GUEST'        => 'ROLE_GUEST',
                'ROLE_EXPIRED'      => 'ROLE_EXPIRED',
            ),
//            'choices_as_values' => true,
        ));
        
        $builder->add('vacate_date', DateType::class, array(
            'years' => range(date('Y') -15, date('Y')),
            'label'         =>  'Date Vacated', 
            'required'      =>  false
        ));
        
        $builder->add('expired', CheckboxType::class, array(
            'required'      =>  false
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
