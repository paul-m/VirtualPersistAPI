<?php
// src/Acme/AccountBundle/Form/Model/Registration.php
namespace VirtualPersistAPI\VirtualPersistBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use VirtualPersistAPI\VirtualPersistBundle\Entity\User;

class Registration
{
    /**
     * @Assert\Type(type="VirtualPersistAPI\VirtualPersistBundle\Entity\User")
     * @Assert\Valid()
     */
    protected $user;

    /**
     * @Assert\NotBlank()
     * @Assert\True()
     */
    protected $termsAccepted;

    public function setUser(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getTermsAccepted()
    {
        return $this->termsAccepted;
    }

    public function setTermsAccepted($termsAccepted)
    {
        $this->termsAccepted = (Boolean) $termsAccepted;
    }
}