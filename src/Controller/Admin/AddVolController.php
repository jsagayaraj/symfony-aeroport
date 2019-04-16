<?php

namespace App\Controller\Admin;

use App\Entity\Flights;
use App\Form\FlightType;
use App\Repository\FlightsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddVolController extends AbstractController
{   
    /**
     * @Route("/admin", name="admin")
     */
    public function indexAdmin()
    {
        return $this->render("admin/index.html.twig");
    }

    /**
     * @Route("/admin/add/vol", name="admin_add_vol")
     */
    public function addFlight(Request $request, ObjectManager $manager)
    {   $flight = new Flights();
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $result = $form->getData();
            // dump($result);
            // die();
            $manager->persist($flight);
            $manager->flush();
            $this->addFlash('success', 'Vol a été bien ajouté');
            return $this->redirectToRoute('admin_show_vol_list');
            
        }else{
            return $this->render ("admin/add_vol/index.html.twig", [
                'form' => $form->createView()
            ]);
        }
    }
    
    /**
     * @Route("/admin/list_de_vol", name="admin_show_vol_list")
     */
    public function adminShowFlight(FlightsRepository $flightsRepo)
    {
        $flight = $flightsRepo->findAll();
    //dump($flight);
    return $this->render("Admin/showvollist.html.twig", [
        'flights' => $flight
    ]);
    }

    /**
     * @Route("/Admin/editvol/{id}", name="admin_edit_vol")
     */
    public function adminEditFlight(Request $request, ObjectManager $manager, Flights $flight)
    {
        $form = $this->createForm(FlightType::class, $flight);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($flight);
            $manager->flush();
             $this->addFlash('success', "Vol bien editer");
            return $this->redirectToRoute('admin_show_vol_list');
        }else{
            return $this->render("Admin/editvol.html.twig", [
                
                'form' => $form->createView()
            ]);

        }
        
    }


    /**********************DELETE VOL ************************/
    /**
     * @Route("/admin/deletevol/{id}", name="admin_delete_vol")
     */
    public function adminDeleteFlight(Request $request, ObjectManager $manager, Flights $flight)
    {
        if($this->isCsrfTokenValid('delete' . $flight->getId(), $request->get('_token')))
            {
                //dump('suppression');
                $manager->remove($flight);
                $manager->flush();
                //return new Response('Suppression');
                $this->addFlash('success', 'Vol supprimé avec succés');
                return $this->redirectToRoute('admin_show_vol_list');
            }
    }
    
}


