<?php

namespace AppBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class TwigmapExtend extends AbstractExtension
{

    // map
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

    //icones 

    public function getIconeFunctions()
    {
        return array(
            new TwigFunction('leaflet_icone', array($this, 'leafletIconeFunction')),
        );
    }

    public function leafletIconeFunction()
    {
        $events = $this -> getEvents();

        foreach($events as $e)
        {
            $marker = display_marker($events);
        }

        return $marker;
    }
}