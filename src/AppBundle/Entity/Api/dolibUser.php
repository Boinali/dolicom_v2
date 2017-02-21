<?php
/**
 * Created by PhpStorm.
 * User: Naister
 * Date: 20/02/2017
 * Time: 15:34
 */

namespace AppBundle\Entity\Api;

//use FOS\UserBundle\Entity\Api\dolibUser as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity\(repositoryClass="AppBundle\Entity\Api")
 * @ORM\Table(name="llx_user")
 */

class dolibUser
{
    /**
     * @var int $rowid
     * @ORM\Id
     * @ORM\Column(name="rowid", type="int", nullable=false)
     *
     *@ORM\GeneratedValue(strategy="AUTO")
     */
    protected $rowid;



}