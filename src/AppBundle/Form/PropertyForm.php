<?php

namespace AppBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use AppBundle\Form\PhotoForm;

class PropertyForm extends AbstractType {
//    public function __construct($em) {
//        $this->em = $em;
//    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('color', TextType::class, array(
            'attr' => array('style' => 'width: 150px')
        ));
        
        $builder->add('dateBuilt', DateType::class, array(
            'years' => range(date('Y') -15, date('Y')),
        ));
        
        $builder->add('hasHoaLien', CheckboxType::class, array(
            'required' => false
        ));
        
        $builder->add('inArrears', CheckboxType::class, array(
            'required' => false
        ));
        
        $builder->add('houseNumber', TextType::class, array(
            'required' => false,
            'attr' => array('style' => 'width: 50px')
        ));
        
        $builder->add('isOccupied', CheckboxType::class, array(
            'required' => false
        ));
        
        $builder->add('lotNumber', TextType::class, array(
            'attr' => array('style' => 'width: 50px')
        ));
        
        $builder->add('status', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Owner Resides'   => 'Owner Resides',
                'For Sale'        => 'For Sale',
                'Rental'          => 'Rental',
                'HOA Owned'       => 'HOA Owned',
                'Bank Owned'      => 'Bank Owned',
                'HUD Owned'       => 'HUD Owned',
                'Builder Owned'   => 'Builder Owned',
                'In Foreclosure'  => 'In Foreclosure'
            ),
//            'choices_as_values' => true,
        ));
        
        $builder->add('street', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Brandy Mill Drive'     => 'Brandy Mill Drive',
                'Spring Brook Court'    => 'Spring Brook Court',
                'Spring Flower Way'     => 'Spring Flower Way',
                'Lavender Hill Drive'   => 'Lavender Hill Drive',
                'Cosmos Lane'           => 'Cosmos Lane',
            ),
//            'choices_as_values' => true,
        ));
        
        $builder->add('type', ChoiceType::class, array(
            'required' => true,
            'placeholder'   => 'Choose an option',
            'choices'  => array(
                'Residential'           => 'Residential',
                'Drainage Pond'         => 'Drainage Pond',
                'Undeveloped Lot'       => 'Undeveloped Lot',
                'Reserve Area'          => 'Reserve Area',
            ),
//            'choices_as_values' => true,
        ));
        
        $builder->add('user', EntityType::class, array(
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
            
        $builder->add('photos', CollectionType::class, array(
//            'type' => new PhotoForm(),
            'entry_type'   => PhotoForm::class,
            'allow_add'    => true,
            'by_reference' => false,
        ));
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Property',
        ));
    }
    
    public function getName()
    {
        return 'property';
    }
}