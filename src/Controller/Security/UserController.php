<?php

namespace App\Controller\Security;

use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserController extends Controller{
  /**
  * @Route("/inscription", name="registration")
  */

  public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){
    $user = new User();
    $form = $this->createForm(UserType::class, $user);
    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid())
    {
      
      $password = $encoder->encodePassword($user, $user->getPassword());
      $user->setPassword($password);
      $user->setStatus('passenger');
      $user->setIsActive(true);
      //$user->addRole("ROLE_ADMIN");
      $manager->persist($user);
      $manager->flush();
      $this->addFlash('success', 'Vous êtes bien enregistré');
      return $this->redirectToRoute('home');
    }else{
      return $this->render ("security/registration.html.twig",[ 
        'form' => $form->createView(),
        'title' => 'Inscription'
      ]);
    }

    
  }


  /**
   * @Route("/connexion", name="login")
   */
  public function login(Request $request, AuthenticationUtils $authenticationUtils) {
      // get the login error if there is one
      $error = $authenticationUtils->getLastAuthenticationError();
      // last username entered by the user
      $lastUsername = $authenticationUtils->getLastUsername();
      //
      $form = $this->get('form.factory')
              ->createNamedBuilder(null)
              ->add('_username', null, ['label' => 'Email'])
              ->add('_password', PasswordType::class, ['label' => 'Mot de passe'])
              ->add('Connexion', SubmitType::class, ['label' => 'Connexion', 'attr' => ['class' => 'btn-primary btn-block']])
              ->getForm();
      return $this->render('security/login.html.twig', [
                  'title' => 'Connexion',
                  'form' => $form->createView(),
                  'last_username' => $lastUsername,
                  'error' => $error,
      ]);
  }

  /**
   * @Route("/profile", name="profile")
   */
  public function profile(){
    return $this->render("home/profile.html.twig");
  }

  
  /**
   * @Route("/logout", name="logout")
   */
  public function logout()
  {
      return $this->render("home/index.html.twig",[
          'title' => 'Accueil'
      ]);
  }


}