<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('AppBundle:Events')->findAll();

        return $this->render('events/index.html.twig', array(
            'events' => $events,
        ));
    }

    public function jsonAction(Request $request)
    {

        // em entity manager
        $em = $this->getDoctrine()->getManager(); 
        switch ($request->query->get('option')){
            case 'allEvent':
            $events = $em->getRepository('AppBundle:Events')->findAll();
            break;
            case 'pastEvent':
            $events = $em->getRepository('AppBundle:Events')->findPastEvent();
            break;
            
        }
        
        //$events = $em->getRepository('AppBundle:Events')->findAll();
        //$events = $em->getRepository('AppBundle:Events')->find();

        $curl = $this -> get('AppBundle\Network\ServiceCurl');

        $events = $this -> getEvents();
        $gpsEvents = [];
    
            foreach($events as $e) {
                $adresse = str_replace(' ', '+', $e ->getAdresse()); // lorsque la propriété est en privé il faut faite le get
                $suggestions = json_decode($curl->curl_get($adresse),true);
                $gps  = $suggestions['features'][0]['geometry']['coordinates'];
                $e ->latitude = $gps[1];
                $e ->longitude = $gps[0];
                $gpsEvents[] = $e;

            }

            // var_dump(json_encode($gpsEvents)); die;

        return $this->json($gpsEvents);
    }
        

    /**
     * Creates a new event entity.
     *
     */
    public function newAction(Request $request)
    {
        $events = new Events();
        $form = $this->createForm('AppBundle\Form\EventsType', $events);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events_show', array('id' => $events->getId()));
        }

        return $this->render('events/new.html.twig', array(
            'event' => $events,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction(Events $events)
    {
        $deleteForm = $this->createDeleteForm($events);

        return $this->render('events/show.html.twig', array(
            'event' => $events,
            'delete_form' => $deleteForm->createView(),
            
        ));
    }

    /**
     * Displays a form to edit an existing event entity.
     *
     */
    public function editAction(Request $request, Events $events)
    {
        $deleteForm = $this->createDeleteForm($events);
        $editForm = $this->createForm('AppBundle\Form\EventsType', $events);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('events_edit', array('id' => $events->getId()));
        }

        return $this->render('events/edit.html.twig', array(
            'event' => $events,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a event entity.
     *
     */
    public function deleteAction(Request $request, Events $events)
    {
        $form = $this->createDeleteForm($events);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($events);
            $em->flush();
        }

        return $this->redirectToRoute('events_index');
    }

    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $events)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('events_delete', array('id' => $events->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
