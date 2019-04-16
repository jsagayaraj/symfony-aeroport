<?php

namespace App\Controller\Admin;

use App\Entity\Departures;
use App\Form\DeparturesType;
use App\Repository\DeparturesRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeparturesController extends AbstractController
{
        
    /**
     * @Route("/admin/ville", name="admin_ville")
     */
    public function index(DeparturesRepository $repo)
    {   
        $ville = $repo->findAll();
        return $this->render('admin/ville/index.html.twig', [
            'villes' => $ville
        ]);
    }

    /**
     * @Route("/admin/add/ville", name="admin_add_ville")
     */
    public function addVille(Request $request, ObjectManager $em)
    {
        $ville = new Departures();
        
        $form = $this->createForm(DeparturesType::class, $ville);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', "Ville bine ajouté");
            return $this->redirectToRoute("admin_ville");
        }else{
            return $this->render("admin/ville/add.html.twig",[
                'form' => $form->createView()
            ]);            
        }
    }

    ///////////////////////////UPDATE////////////////////////////
    /**
     * @Route("/admin/edit/ville/{id}", name="admin_edit_ville")
     */
    public function editVille(Departures $ville, ObjectManager $em, Request $request)
    {
        
        $form = $this->createForm(DeparturesType::class, $ville);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->persist($ville);
            $em->flush();
            $this->addFlash('success', "Ville bine modifié");
            return $this->redirectToRoute("admin_ville");
        }else{
            return $this->render("admin/ville/edit.html.twig",[
                'form' => $form->createView()
            ]);            
        }
    }

    ////////////////////////////////DELETE///////////////////////////////
     /**
     * @Route("/admin/delete/ville/{id}", name="admin_delete_ville")
     * 
     */
    public function deleteVille (Departures $ville, ObjectManager $em, Request $request)
    {
        if($this->isCsrfTokenValid('delete' . $ville->getId(), $request->get('_token')))
        {
            //dump('suppression');
            $em->remove($ville);
            $em->flush();
            //return new Response('Suppression');
            $this->addFlash('success', 'Bien supprimé avec succés');
        }
        return $this->redirectToRoute('admin_ville');
    }
}
