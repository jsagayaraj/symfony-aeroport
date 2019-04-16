<?php

namespace App\Controller\ListeDeVol;

use App\Entity\Flights;
use App\Repository\FlightsRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class VolController extends AbstractController
{
    // /**
    //  * @Route("/addflight", name="add_vol")
    //  */
    // public function addVol()
    // {   
    //   $date = new \DateTime();
    //     $flights = new Flights();
    //     $flights->setFlightName('Air France')
    //           ->setFlightNumber('A24513')
    //           ->setDepartures('Paris')
    //           ->setArrivals('Lyon')
    //           ->setDate($date)
    //           ->setCreatedAt($date)
    //           ->setmaxPlace(50)
    //           ->setImage("image")
    //           ->setStatus(true)
    //           ->setPrice(304);

    //           $em = $this->getDoctrine()->getManager();
    //           $em->persist($flights);
    //           $em->flush();
    //     return $this->render('vol/vollist.html.twig',[
    //       'flight' => 'flights'
    //     ]);
    // }

    /**
     * @Route("/show_flight_list", name="showFlightList")
     */
    public function showFlightList(FlightsRepository $flightsRepo)
    {
      $flight = $flightsRepo->findAll();
      //dump($flight);
      return $this->render("vol/vollist.html.twig", [
        'flights' => $flight
      ]);
    }

    /**
     * @Route("/show_flight/{id}", name="show_flight")
     */
    public function showFlight(Flights $flight, FlightsRepository $flightsRepo)
    {
     
      return $this->render("vol/vol.html.twig", [
        'flight' => $flight
      ]);
    }


  


}