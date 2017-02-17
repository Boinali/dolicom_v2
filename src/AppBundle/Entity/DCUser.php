<?//
//namespace AppBundle\Entity;
//
//use FOS\UserBundle\Entity\User as BaseUser;
//use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Validator\Contraints  as Assert;
///**
// * @ORM\Entity
// * @ORM\Table(name="dc_user")
// */
//
//class DCUser extends BaseUser
//{
//    public function __construct()
//    {
//        parent::__construct();
//    }
//
//    /* dolibarr attribute*/
//
//    /**
//     * @var string
//     * @ORM\Column(name="dLogin", type="varchar", nullable=true, Length=24)
//     * @Assert\NotBlank
//     */
//    protected $dLogin;
//    /**
//     * @var string
//     */
//    protected $dMDP;
//    /**
//     * @var string
//     * @ORM\Column(name="dFirstname", type="varchar", nullable=true, Length=50)
//     * @Assert\NotBlank
//     */
//    protected $dFirstname;
//    /**
//     * @var string
//     * @ORM\Column(name="dLastname", type="varchar", nullable=true, Length=50)
//     */
//    protected $dLastname;
//    /**
//     * @var string
//     * @ORM\Column(name="dEmail", type="varchar", nullable=true, Length=255)
//     * @Assert\Email
//     */
//    protected $dEmail;
//
//    /* Getters & Setters */
//
//    /**
//     * @return string
//     */
//    public function getDLogin()
//    {
//        return $this->dLogin;
//    }
//    /**
//     * @param string $dLogin
//     * @return user
//     */
//    public function setDLogin($dLogin)
//    {
//        $this->dLogin = $dLogin;
//        return $this;
//    }
//    /**
//     * @return string
//     */
//    public function getDMDP()
//    {
//        return $this->dMDP;
//    }
//    /**
//     * @param string $dMDP
//     * @return user
//     */
//    public function setDMDP($dMDP)
//    {
//        $this->dMDP = $dMDP;
//        return $this;
//    }
//    /**
//     * @return string
//     */
//    public function getDFirstname()
//    {
//        return $this->dFirstname;
//    }
//    /**
//     * @param string $dFirstname
//     * @return user
//     */
//    public function setDFirstname($dFirstname)
//    {
//        $this->dFirstname = $dFirstname;
//        return $this;
//    }
//
//    /**
//     * @return string
//     */
//    public function getDLastname()
//    {
//        return $this->dLastname;
//    }
//    /**
//     * @param string $dLastname
//     * @return user
//     */
//    public function setDLastname($dLastname)
//    {
//        $this->dLastname = $dLastname;
//        return $this;
//    }
//
//    /**
//     * @return string
//     */
//    public function getDEmail()
//    {
//        return $this->dEmail;
//    }
//    /**
//     * @param string $dEmail
//     * @return user
//     */
//    public function setDEmail($dEmail)
//    {
//        $this->dEmail = $dEmail;
//        return $this;
//    }
//
//}