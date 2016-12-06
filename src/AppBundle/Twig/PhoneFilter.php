<?php

namespace AppBundle\Twig;

class PhoneFilter extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('phone', array($this, 'phoneFilter')),
        );
    }

    public function phoneFilter($num)
    {
        return ($num)?'('.substr($num,0,3).') '.substr($num,3,3).'-'.substr($num,6,4):'&nbsp;';
    }

    public function getName()
    {
        return 'phone_filter';
    }
}