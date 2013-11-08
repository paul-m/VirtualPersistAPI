<?php
// src/Acme/AccountBundle/Controller/AccountController.php
namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
    $em = $this->getDoctrine()->getEntityManager();

    $form = $this->createForm(new RegistrationType(), new Registration());

    $form->bind($this->getRequest());

    if ($form->isValid()) {
        $registration = $form->getData();
        $user = $registration->getUser();
        
        $user->setUsername('dummy');
        $user->setUuid(uniqid());

        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('account_register'), 301);
    }

    return $this->render(
        'VirtualPersistBundle:Account:register.html.twig',
        array('form' => $form->createView())
    );
  }

}