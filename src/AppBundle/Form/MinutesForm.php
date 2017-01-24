<?php

namespace AppBundle\Form;
use AppBundle\Entity\Minutes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MinutesForm  extends AbstractType{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('year')
            ->add('quarter')
            ->add('embed_code', TextareaType::class, array(
                'label' =>  'Published Link (not embeded code)',
                ))
            ->add('save', SubmitType::class, array('label' => 'Submit'))
        ;
    }
    
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Minutes::class,
        ));
    }
    
    public function getName()
    {
        return 'minutes';
    }
}
