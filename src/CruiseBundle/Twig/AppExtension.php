<?php

namespace CruiseBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('numeral', array($this, 'numeralFilter')),
        );
    }

    public function numeralFilter($kol, $one, $two, $five)
    {

		if (($kol%100 >10 ) and ($kol%100 < 20)) {$ok = $five;}
		else {
		$ost = $kol%10;
		if ($ost == 1) {$ok = $one;}
		elseif (($ost > 1) and ($ost < 5)) {$ok = $two;}
		else {$ok = $five;};
		};
		return $ok;
    }
	
	
	
	public function getName()
	{
		return "numeral";
	}	
	
	
}