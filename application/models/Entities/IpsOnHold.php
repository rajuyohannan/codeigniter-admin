<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * IpsOnHold
 *
 * @ORM\Table(name="ips_on_hold")
 * @ORM\Entity
 */
class IpsOnHold
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
     * @return IpsOnHold
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
     * @return IpsOnHold
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
