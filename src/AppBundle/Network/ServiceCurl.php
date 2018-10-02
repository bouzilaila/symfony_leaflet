<?php

namespace AppBundle\Network;

// nom du bundle et nom du dossier dans quel il est classé 

class ServiceCurl 
{

/**
 * Service qui permet d'afficher sur une map marqueur par rapport aux coordonnéees
 * 
 * @param string $adresse -> adresse postale dont on veut connaitre les coordonnées GPS
 * 
 * @return array 
 * 
 * @example curl_get(adresse)
 */

    public function curl_get($adresse)
    {
        
        $defaults = [
            CURLOPT_URL => "http://api-adresse.data.gouv.fr/search/?q=$adresse&type=street",
            CURLOPT_HEADER => 0,
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_TIMEOUT => 4
        ]; 

        $ch = curl_init();
        curl_setopt_array($ch, ($defaults));
            if( ! $result = curl_exec($ch))
            {
            trigger_error(curl_error($ch));
            }
            curl_close($ch);
        return $result; 
    }

}