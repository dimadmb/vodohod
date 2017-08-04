<?php

namespace CruiseBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('numeral', array($this, 'numeralFilter')),
            new \Twig_SimpleFilter('ports', array($this, 'portsFilter')),
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
	
    public function portsFilter($port_name)
    {
		$port_name=str_replace("Городец (Галанино)", "Городец", $port_name);
		$port_name=str_replace("Москва (Северный речной вокзал)", "Москва (СРВ)", $port_name);
		$port_name=str_replace("Санкт-Петербург (причал \"Уткина заводь\")", "Санкт-Петербург (причал «Уткина заводь»)", $port_name);
		return $port_name;
    }
	
	
	
}