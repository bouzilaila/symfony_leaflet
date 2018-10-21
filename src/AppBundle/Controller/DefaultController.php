<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('@App/testpage/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'var_test' => 'Hello Word',
        ]);
    }

     /**
     * @Route("/map", name="map")
     */

    public function eventsAction(Request $request)
    {
        
        return $this->render('@App/evenements/evenement.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'events' => $this->getEvents() 
        ]);
    }

    public function getEvents()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findAll();
        
        return $events;
    }

    /**
     * @Route("/icone", name="icone")
     */

    public function evenementsAction(Request $request)
    {
        //$curl = $this -> get('AppBundle\Network\ServiceCurl');

       // $events = $this -> getEvents();
       //$gpsEvents = [];
    
        //foreach($events as $e) {
            //$adresse = str_replace(' ', '+', $e ->getAdresse()); // lorsque la propriété est en privé il faut faite le get
            // $suggestions = json_decode($curl->curl_get($adresse),true);
            // $gps  = $suggestions['features'][0]['geometry']['coordinates'];
            // $e ->latitude = $gps[1];
            // $e ->longitude = $gps[0];
            // $gpsEvents[] = $e;

        // }

        return $this->render('@App/evenements/evenement.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'events' => $this -> getEvents(),
            'popup' => $this -> getPopup()
            // 'latitude' => $gps[1],
            // 'longitude' => $gps[0],


            // 'latitude' => $e->$gps[1],
            // 'longitude' => $e->$gps[0]
        ]);                
    }


}
    