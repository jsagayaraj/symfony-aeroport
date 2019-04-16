<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    
    /**
     * @Route("/admin/show/user", name="admin_show_user")
     */
    public function showUser(UserRepository $userRepo)
    {
        $user = $userRepo->findAll();
        return $this->render("admin/user/show_user.html.twig",[
            'users' => $user,
            'title' => 'Admin',
            
        ]);
    }


    /**
     * @Route("/admin/user-edit/{id}", name="admin_edit_user")
     */
    public function index(Request $request, User $user, ObjectManager $manager)
    {
        
        $form = $this->createFormBuilder($user)
            ->add('firstname')
            ->add('lastname' )
            
            ->add('status', ChoiceType::class,[
                'choices' =>[
                    'Passenger' => 'passenger',
                    'Pilote' => 'pilote',
                    'admin' => 'admin',
                ], 'expanded'=> false,
            ])
            ->add('roles', ChoiceType::class, [
                'choices'  => [
                    'Utilisateur de base' => 'ROLE_USER',
                    'Administrateur' => 'ROLE_ADMIN',
                ],
                'expanded' => true, //liste déroulante
                'multiple' => true, //choice multiple
            ])
            ->getForm();
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            //$user->setStatus('passenger');
            //$user->addRole("ROLE_ADMIN");
            $manager->persist($user);
            $manager->flush();
            $this->addFlash('success', 'Vous êtes bien modifier');
            return $this->redirectToRoute('admin_show_user');
         }
        else{
            return $this->render('admin/user/index.html.twig', [
                'form' => $form->createView(),
                'title' => 'Admin',
            ]);
        }    
    }  

    
} 
