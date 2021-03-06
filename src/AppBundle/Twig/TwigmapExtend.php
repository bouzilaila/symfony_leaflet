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
            new TwigFunction('leaflet_icone', array($this, 'leafletIconeFunction')),
        );
    }

    public function leafletMapFunction($map)
    {
        $mapLeaflet = "<div id='$map'></div>
        <script>
                let mymap = L.map('map').setView([48.8534, 2.3488], 11);

                display_maps(mymap);
        </script>";
    
        return $mapLeaflet;
    }

    //icones 

    public function leafletIconeFunction($icone)
    {
        $marker ="
        {% for e in events %}
            display_marker(mymap, {{ e.latitude}}, {{ e.longitude }})
        {% endfor %}";

        return $marker;
    }
}