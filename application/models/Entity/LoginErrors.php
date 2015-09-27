<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * LoginErrors
 *
 * @ORM\Table(name="login_errors")
 * @ORM\Entity
 */
class LoginErrors
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ai", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ai;

    /**
     * @var string
     *
     * @ORM\Column(name="username_or_email", type="string", length=255, nullable=false)
     */
    private $usernameOrEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="IP_address", type="string", length=45, nullable=false)
     */
    private $ipAddress;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime", nullable=false)
     */
    private $time;


    /**
     * Get ai
     *
     * @return integer 
     */
    public function getAi()
    {
        return $this->ai;
    }

    /**
     * Set usernameOrEmail
     *
     * @param string $usernameOrEmail
     * @return LoginErrors
     */
    public function setUsernameOrEmail($usernameOrEmail)
    {
        $this->usernameOrEmail = $usernameOrEmail;

        return $this;
    }

    /**
     * Get usernameOrEmail
     *
     * @return string 
     */
    public function getUsernameOrEmail()
    {
        return $this->usernameOrEmail;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return LoginErrors
     */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;

        return $this;
    }

    /**
     * Get ipAddress
     *
     * @return string 
     */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     * @return LoginErrors
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime 
     */
    public function getTime()
    {
        return $this->time;
    }
}
