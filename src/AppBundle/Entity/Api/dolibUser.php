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
 * @ORM\Entity\customer
 * @ORM\Table(name="llx_user")
 */
class dolibUser
{
    public function __construct()
    {
        parent::__construct();
        // your own logic
    }


    /**
     * @ORM\rowid
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $rowid;

    /**
     * @return integer
     */
    public function getRowId()
    {
        return $this->rowid;
    }
}