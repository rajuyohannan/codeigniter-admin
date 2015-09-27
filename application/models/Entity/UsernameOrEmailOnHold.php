<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * UsernameOrEmailOnHold
 *
 * @ORM\Table(name="username_or_email_on_hold")
 * @ORM\Entity
 */
class UsernameOrEmailOnHold
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
     * @return UsernameOrEmailOnHold
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
     * Set time
     *
     * @param \DateTime $time
     * @return UsernameOrEmailOnHold
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
