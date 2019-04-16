<?php

namespace App\Controller\Admin;

use App\Entity\Arrivals;
use App\Form\ArrivalsType;
use App\Repository\ArrivalsRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ArrivalsController extends AbstractController
{
    /**
     * @Route("/admin/arrivals", name="admin_arrivals")
     */
    public function index(ArrivalsRepository $repo)
    {   
        $ville = $repo->findAll();
        return $this->render('admin/arrivals/index.html.twig', [
            'villes' => $ville,
            
        ]);
    }

    /**
     * @Route("/admin/add/ville_arriver", name="admin_add_ville_arriver")
     */
    public function addVille(Request $request, ObjectManager $em)
    {
        $ville = new Arrivals();
        
        $form = $this->createForm(ArrivalsType::class, $ville);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', "Ville bine ajouté");
            return $this->redirectToRoute("admin_arrivals");
        }else{
            return $this->render("admin/arrivals/add.html.twig",[
                'form' => $form->createView()
            ]);            
        }
    }

    ///////////////////////////UPDATE////////////////////////////
    /**
     * @Route("/admin/edit/ville/arriver/{id}", name="admin_edit_ville_arriver")
     */
    public function editVille(Arrivals $ville, ObjectManager $em, Request $request)
    {
        
        $form = $this->createForm(ArrivalsType::class, $ville);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', "Ville bine modifié");
            return $this->redirectToRoute("admin_arrivals");
        }else{
            return $this->render("admin/arrivals/edit.html.twig",[
                'form' => $form->createView()
            ]);            
        }
    }

     ////////////////////////////////DELETE///////////////////////////////
     /**
     * @Route("/admin/delete/ville/arriver/{id}", name="admin_delete_ville_arriver")
     * 
     */
    public function deleteVilleDarriver (Arrivals $ville, ObjectManager $em, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $ville->getId(), $request->get('_token')))
        {
            //dump('suppression');
            $em->remove($ville);
            $em->flush();
            //return new Response('Suppression');
            $this->addFlash('success', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin_arrivals');
    }
}
