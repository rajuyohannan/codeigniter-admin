<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * CiSessions
 *
 * @ORM\Table(name="ci_sessions", uniqueConstraints={@ORM\UniqueConstraint(name="ci_sessions_id_ip", columns={"id", "ip_address"})}, indexes={@ORM\Index(name="ci_sessions_timestamp", columns={"timestamp"})})
 * @ORM\Entity
 */
class CiSessions
{
    /**
     * @var integer
     *
     * @ORM\Column(name="ai", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $ai;

    /**
     * @var string
     *
     * @ORM\Column(name="id", type="string", length=40, nullable=false)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="ip_address", type="string", length=45, nullable=false)
     */
    private $ipAddress;

    /**
     * @var integer
     *
     * @ORM\Column(name="timestamp", type="integer", nullable=false)
     */
    private $timestamp;

    /**
     * @var string
     *
     * @ORM\Column(name="data", type="blob", length=65535, nullable=false)
     */
    private $data;


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
     * Set id
     *
     * @param string $id
     * @return CiSessions
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get id
     *
     * @return string 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ipAddress
     *
     * @param string $ipAddress
     * @return CiSessions
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
     * Set timestamp
     *
     * @param integer $timestamp
     * @return CiSessions
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return integer 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return CiSessions
     */
    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }
}
