<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TransactionsForm extends AbstractType {
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add('account', EntityType::class, array(
            'required'      => false,
            'multiple'      => false,
            'class'         =>  'AppBundle:Account',
            'choice_label'  =>  'id',
            'query_builder' => function (EntityRepository $er) {
                return $er->createQueryBuilder('a')
                    ->addOrderBy('a.id', 'ASC');
            },
            'label'         =>  'Account',
            'placeholder'   =>  'Choose'
        ));
            
        $builder->add('type', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Debit'     => 'debit',
                'Credit'    => 'credit',
                'Transfer'  => 'transfer',
            ),
        ));
            
        $builder->add('description', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Annual Dues'           => 'annual-dues',
                'Finance Charge'        => 'finance-charge',
                'Fine'                  => 'fine',
                'Assessment'            => 'assessment',
                'Payment'               => 'payment',
                'Forgiveness/Waiver'    => 'forgiveness-waiver',
                'Reimbursement'         => 'reimbursement',
                'Over payment'          => 'over-payment',
                'Other'                 => 'other'
            ),
        ));
        
        $builder->add('amount');
        
        $builder->add('note', TextType::class, array(
        ));
            
//        $builder->add('property', 'entity', array(
//            'required'      => false,
//            'multiple'      => false,
//            'class'         => 'MainBundle:Property',
//            'choice_label'  => function(Property $prop){return $prop->getHouseNumber().' '.$prop->getStreet();},
//            // function(EntityRepository $er){return $er->getDisplayName();},
//            //function(Property $prop){return $prop->getHouseNumber().' '.$prop->getStreet();},
////            function (EntityRepository $er) {return $er->createQueryBuilder('p')
////                    ->select('p.house_number');},
//            'query_builder' => function (EntityRepository $er) {
//                return $er->createQueryBuilder('p')
//                    ->addOrderBy('p.street', 'ASC')
//                    ->addOrderBy('p.house_number', 'ASC');
//            },
//            'label'         =>  'Property',
//            'placeholder'   =>  'Choose'
//        ));
        
        $builder->add('save', SubmitType::class, array('label' => 'Submit'));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Transactions',
        ));
    }
    
    public function getName()
    {
        return 'transactions';
    }
}
