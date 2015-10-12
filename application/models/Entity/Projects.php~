<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Projects
 *
 * @ORM\Table(name="projects", indexes={@ORM\Index(name="type_id", columns={"type_id"}), @ORM\Index(name="currency_id", columns={"currency_id"}), @ORM\Index(name="client_id", columns={"client_id"}), @ORM\Index(name="stage_id", columns={"stage_id"}), @ORM\Index(name="codebase_id", columns={"codebase_id"}), @ORM\Index(name="created_by", columns={"created_by"})})
 * @ORM\Entity
 */
class Projects
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="timeline", type="integer", nullable=false)
     */
    private $timeline;

    /**
     * @var integer
     *
     * @ORM\Column(name="value", type="integer", nullable=false)
     */
    private $value;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=false)
     */
    private $updatedOn;

    /**
     * @var \Clients
     *
     * @ORM\ManyToOne(targetEntity="Clients")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     * })
     */
    private $client;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="type_id", referencedColumnName="id")
     * })
     */
    private $type;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="currency_id", referencedColumnName="id")
     * })
     */
    private $currency;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="stage_id", referencedColumnName="id")
     * })
     */
    private $stage;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="codebase_id", referencedColumnName="id")
     * })
     */
    private $codebase;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="user_id")
     * })
     */
    private $createdBy;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Projects
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set timeline
     *
     * @param integer $timeline
     * @return Projects
     */
    public function setTimeline($timeline)
    {
        $this->timeline = $timeline;

        return $this;
    }

    /**
     * Get timeline
     *
     * @return integer 
     */
    public function getTimeline()
    {
        return $this->timeline;
    }

    /**
     * Set value
     *
     * @param integer $value
     * @return Projects
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return integer 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Projects
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return Projects
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;

        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set client
     *
     * @param \Clients $client
     * @return Projects
     */
    public function setClient(\Clients $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \Clients 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set type
     *
     * @param \Terms $type
     * @return Projects
     */
    public function setType(\Terms $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \Terms 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set currency
     *
     * @param \Terms $currency
     * @return Projects
     */
    public function setCurrency(\Terms $currency = null)
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Get currency
     *
     * @return \Terms 
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * Set stage
     *
     * @param \Terms $stage
     * @return Projects
     */
    public function setStage(\Terms $stage = null)
    {
        $this->stage = $stage;

        return $this;
    }

    /**
     * Get stage
     *
     * @return \Terms 
     */
    public function getStage()
    {
        return $this->stage;
    }

    /**
     * Set codebase
     *
     * @param \Terms $codebase
     * @return Projects
     */
    public function setCodebase(\Terms $codebase = null)
    {
        $this->codebase = $codebase;

        return $this;
    }

    /**
     * Get codebase
     *
     * @return \Terms 
     */
    public function getCodebase()
    {
        return $this->codebase;
    }

    /**
     * Set createdBy
     *
     * @param \Users $createdBy
     * @return Projects
     */
    public function setCreatedBy(\Users $createdBy = null)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \Users 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }
}
