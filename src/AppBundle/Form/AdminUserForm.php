<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class AdminUserForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('roles', ChoiceType::class, array(
            'required'      => true,
            'multiple'      => true,
            'choices'  => array(
                'ROLE_SUPER_ADMIN'  => 'ROLE_SUPER_ADMIN',
                'ROLE_ADMIN'        => 'ROLE_ADMIN',
                'ROLE_PRESIDENT'        => 'ROLE_PRESIDENT',
                'ROLE_SECRETARY'        => 'ROLE_SECRETARY',
                'ROLE_TREASURER'        => 'ROLE_TREASURER',
                'ROLE_ACCOUNTANT'   => 'ROLE_ACCOUNTANT',
                'ROLE_TRUSTEE'      => 'ROLE_TRUSTEE',
                'ROLE_MODERATOR'    => 'ROLE_MODERATOR',
                'ROLE_HOMEOWNER'    => 'ROLE_HOMEOWNER',
                'ROLE_GUEST'        => 'ROLE_GUEST',
                'ROLE_EXPIRED'      => 'ROLE_EXPIRED',
            ),
        ));
        
        $builder->add('vacate_date', DateType::class, array(
            'widget' => 'single_text',
            'label'         =>  'Date Vacated', 
            'required'      =>  false
        ));
        
        $builder->add('expired', CheckboxType::class, array(
            'required'      =>  false
        ));
        
        $builder->add('is_trustee', CheckboxType::class, array(
            'required'      =>  false
        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
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
