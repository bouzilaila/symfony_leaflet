<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigmapExtend extends AbstractExtension
{
    public function getFunctions()
    {
        return array(
            new TwigFunction('leaflet_map', array($this, 'leafletMapFunction')),
        );
    }

    public function leafletMapFunction($map)
    {
        $mapLeaflet = "<div id='$map'></div>";
    
        return $mapLeaflet;
    }
}