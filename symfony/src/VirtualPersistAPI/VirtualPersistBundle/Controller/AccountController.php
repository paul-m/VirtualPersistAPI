<?php
// src/Acme/AccountBundle/Controller/AccountController.php
namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use VirtualPersistAPI\VirtualPersistBundle\Form\Type\RegistrationType;
use VirtualPersistAPI\VirtualPersistBundle\Form\Model\Registration;

class AccountController extends Controller
{
    /**
     * Route("/register")
     * Template()
     */
    public function registerAction()
    {
        $form = $this->createForm(
            new RegistrationType(),
            new Registration()
        );

        return $this->render(
            'VirtualPersistBundle:Account:register.html.twig',
            array('form' => $form->createView())
        );
    }

  /**
   * Route("/register/create")
   * Template()
   */
  public function createAction(Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $form = $this->createForm(new RegistrationType(), new Registration());

    $form->bind($this->getRequest());

    if ($form->isValid()) {
        $registration = $form->getData();
        $user = $registration->getUser();
        
        $user->setUsername('dummy');
        $user->setUuid(uniqid());

        $factory = $this->get('security.encoder_factory');
        
        $encoder = $factory->getEncoder($user);
        $password = $encoder->encodePassword($user->getPassword(), $user->getSalt());
        $user->setPassword($password);

        $repository = $this->getDoctrine()
            ->getRepository('VirtualPersistBundle:Role');
        $role = $repository->findByRole('USER_DEFAULT');

        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('login'), 301);
    }

    return $this->render(
        'VirtualPersistBundle:Account:register.html.twig',
        array('form' => $form->createView())
    );
  }

  /**
   * Route("/login")
   * Template()
   */
  public function loginAction() {
    $request = $this->getRequest();
    $session = $request->getSession();
    
    // get the login error if there is one
    if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
      $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
    } else {
      $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
    }

    return $this->render('VirtualPersistBundle:Account:login.html.twig', array(
      // last username entered by the user
      'last_username' => $session->get(SecurityContext::LAST_USERNAME),
      'error'         => $error,
    ));
  }

}