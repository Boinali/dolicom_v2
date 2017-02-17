<?
namespace AppBundle\Entity;

use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dc_user")
 */

class DCUser extends BaseUser
{
    public function __construct()
    {
        parent::__construct();
    }

    /* dolibarr attribute*/

    /**
     * @var string
     *
     * @ORM\Column(name="dLogin", type="varchar(24)", nullable=true)
     */
    protected $dLogin;
    /**
     * @var string
     */
    protected $dMDP;
    /**
     * @var string
     *
     * @ORM\Column(name="dFirstname", type="varchar(50)", nullable=true)
     */
    protected $dFirstname;
    /**
     * @var string
     *
     * @ORM\Column(name="dLastname", type="varchar(50)", nullable=true)
     */
    protected $dLastname;
    /**
     * @var string
     *
     * @ORM\Column(name="dEmail", type="varchar(255)", nullable=true)
     */
    protected $dEmail;

    /*
     * Getters & Setters
     *
     * */


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