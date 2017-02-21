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
var_dump('toto'); die();
class dolibUser
{
    /**
     * @var integer $rowid
     * @ORM\Id
     * @ORM\Column(name="rowid", type="integer", nullable=false)
     *
     *@ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $rowid;

    /**
     * @var string $email
     * @ORM\Column(name="email", type="integer", nullable=true)
     *
     */
    protected $email;
    /**
     * @var string $login
     * @ORM\Column(name="login", type="integer", nullable=false)
     *
     */
    protected $login;

    /**
     * @return string
     */
    public function getRowid()
    {
        return $this->rowid;
    }

    /**
     * @param int $rowid
     */
    public function setRowid($rowid)
    {
        $this->rowid = $rowid;
    }

    /**
     * @return string
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param string $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }


}