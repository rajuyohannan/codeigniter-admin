<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * DeniedAccess
 *
 * @ORM\Table(name="denied_access")
 * @ORM\Entity
 */
class DeniedAccess
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
     * @var boolean
     *
     * @ORM\Column(name="reason_code", type="boolean", nullable=true)
     */
    private $reasonCode;


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
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return DeniedAccess
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
     * @return DeniedAccess
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

    /**
     * Set reasonCode
     *
     * @param boolean $reasonCode
     * @return DeniedAccess
     */
    public function setReasonCode($reasonCode)
    {
        $this->reasonCode = $reasonCode;

        return $this;
    }

    /**
     * Get reasonCode
     *
     * @return boolean 
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }
}
