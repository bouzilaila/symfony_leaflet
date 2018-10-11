<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigmapExtend extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('map', array($this, 'mapFunction')),
        );
    }

    public function mapFunction($map)
    {
        $map = "<div id='$map'></div>";
    
        return $map;
    }
}