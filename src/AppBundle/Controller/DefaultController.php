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
     * @Route("/events", name="events")
     */

    public function eventsAction(Request $request)
    {
        
        return $this->render('@App/evenements/evenement.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            
        ]);
    }

    public function getEvents()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findAll();

        foreach ($events as $e){

            echo $events->getContent();
            
            return $events;
        }

        
    }

    public function evenementsAction(Request $request)
    {
        $curl = $this -> get('AppBundle\Network\ServiceCurl');

        $events = $this -> getEvenements();
        $gpsEvents = [];

        foreach($events as $e) {
            $adresse = str_replace(' ', '+', $e['adresse']);
            $suggestions = json_decode($curl->curl_get($adresse),true);
            $gps  = $suggestions['features'][0]['geometry']['coordinates'];
            $e['latitude'] = $gps[1];
            $e['longitude'] = $gps[0];
            $gpsEvents[] = $e;
        }

        return $this->render('@App/evenements/evenement.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'evenements' => $gpsEvents
        ]);                
    }


}
    

     /**
     * @Route("/liste", name="annuaire")
     */

    /*public function annuaireAction(Request $request)
    {
        
        return $this->render('@App/annuaire/liste.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'annuaire' => $this -> getList()
        ]);

    }*/

     /**
     * @Route("/coordonnees/{id}", name="coordonnees")
     */

    /*public function coordonneesAction(Request $request, $id)
    {
        // var_dump($this -> getList()[$id]); die;
        $personne = $this->getList()[$id];
        $adresse = str_replace(' ', '+', $personne['adresse']);
        // $suggestions = json_decode($this -> curl_get($adresse), true);

        // pour rendre le service actif
        $curl = $this -> get('AppBundle\Network\ServiceCurl');
        $suggestions = json_decode($curl->curl_get($adresse), true);
        
        $gps  = $suggestions['features'][0]['geometry']['coordinates'];

        return $this->render('@App/annuaire/coordonnees.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'annuaire' => $this -> getList()[$id],
            'latitude' => $gps[1],
            'longitude' => $gps[0]
        ]);

    }*/

    /*protected function getList()
    {
        $liste = [

            ['nom' => 'Bouzi', 'prenom' => 'Laila', 'email' => 'laila86@hotmail.fr', 'telephone' => '0677784110', 'adresse'=>'9 rue de la Garenne 60100 Creil'],
            ['nom' => 'Dupond', 'prenom' => 'Marie', 'email' => 'marie@hotmail.fr', 'telephone' => '0678784150',  'adresse'=>'7 rue de la Maternité 60100 Creil'],
            ['nom' => 'Smith', 'prenom' => 'John', 'email' => 'mrsmith@hotmail.fr', 'telephone' => '06234489110',  'adresse'=>'5 rue de Paris 60200 Compiègne'],
            ['nom' => 'Martin', 'prenom' => 'Jean', 'email' => 'jeanm@hotmail.fr', 'telephone' => '0675484100', 'adresse'=>'105 rue Saint Josephe 60200 Compiègne']      
        ];

    return $liste;
    }*/

    /**
     * @Route("/events", name="events")
     */

    
   /* protected function getEvenements()
    {
        $events = [
            ['nom' => 'Meeting concert place de la Concorde', 'date' => '17 septembre 2018', 'adresse' => 'Place de la Concorde, 75008 Paris'],
            ['nom' => 'Le lancement au Zénith de Paris', 'date' => '1 fevrier 2019', 'adresse' => '211 Avenue Jean Jaurès, 75019 Paris'],
            ['nom' => 'La manif-concert', 'date' => '21 avril 2019', 'adresse' => 'Av. des Champs-Élysées, 75008 Paris']  
        ];

        return $events;
    }*/