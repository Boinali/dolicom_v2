<?php
// src/AppBundle/Entity/User.php

namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

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
    public function setgithub_id($github_id)
    {
        $this->github_id = $github_id;

        return $this;
    }

    /**
     * @return string
     */
    public function getgithub_id()
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
}
