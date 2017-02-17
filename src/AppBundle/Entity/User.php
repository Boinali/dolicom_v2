<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="dc_user")
 */
class User extends BaseUser
{

    public function __construct()
    {
        parent::__construct();
        // your own logic
    }
           
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="github_id", type="string", nullable=true)
     */
    protected $github_id;

    protected $githubAccessToken;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param string $github_id
     * @return User
     */
    public function setGithubId($github_id)
    {
        $this->github_id = $github_id;
        return $this;
    }
   /* public function setgithub_id($github_id)
    {
        $this->github_id = $github_id;

        return $this;
    }*/

    /**
     * @return string
     */
    public function getGithubId()
    {
        return $this->github_id;
    }

    /**
     * @param string $githubAccessToken
     * @return User
     */
    public function setgithubAccessToken($githubAccessToken)
    {
        $this->githubAccessToken = $githubAccessToken;

        return $this;
    }

    /**
     * @return string
     */
    public function getgithubAccessToken()
    {
        return $this->githubAccessToken;
    }


    /* dolibarr attribute*/

    /**
     * @var string
     * @ORM\Column(name="dLogin", type="string", nullable=true, length=24)
     *
     */
    protected $dLogin;
    /**
     * @var string
     */
    protected $dMDP;
    /**
     * @var string
     * @ORM\Column(name="dFirstname", type="string", nullable=true, length=50)
     *
     */
    protected $dFirstname;
    /**
     * @var string
     * @ORM\Column(name="dLastname", type="string", nullable=true, length=50)
     */
    protected $dLastname;
    /**
     * @var string
     * @ORM\Column(name="dEmail", type="string", nullable=true, length=255)
     * @Assert\Email(
     *  message = "The email '{{ value }}' is not a valid email.",
     *  checkMX = true
     * )
     */
    protected $dEmail;

    /* Getters & Setters */

    /**
     * @return string
     */
    public function getDLogin()
    {
        return $this->dLogin;
    }
    /**
     * @param string $dLogin
     * @return user
     */
    public function setDLogin($dLogin)
    {
        $this->dLogin = $dLogin;
        return $this;
    }
    /**
     * @return string
     */
    public function getDMDP()
    {
        return $this->dMDP;
    }
    /**
     * @param string $dMDP
     * @return user
     */
    public function setDMDP($dMDP)
    {
        $this->dMDP = $dMDP;
        return $this;
    }
    /**
     * @return string
     */
    public function getDFirstname()
    {
        return $this->dFirstname;
    }
    /**
     * @param string $dFirstname
     * @return user
     */
    public function setDFirstname($dFirstname)
    {
        $this->dFirstname = $dFirstname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDLastname()
    {
        return $this->dLastname;
    }
    /**
     * @param string $dLastname
     * @return user
     */
    public function setDLastname($dLastname)
    {
        $this->dLastname = $dLastname;
        return $this;
    }

    /**
     * @return string
     */
    public function getDEmail()
    {
        return $this->dEmail;
    }
    /**
     * @param string $dEmail
     * @return user
     */
    public function setDEmail($dEmail)
    {
        $this->dEmail = $dEmail;
        return $this;
    }
}
