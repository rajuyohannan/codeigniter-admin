<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Dois
 *
 * @ORM\Table(name="dois", indexes={@ORM\Index(name="source_id", columns={"source_id"}), @ORM\Index(name="project_id", columns={"project_id"}), @ORM\Index(name="estimation_id", columns={"estimation_id"}), @ORM\Index(name="created_by", columns={"created_by"})})
 * @ORM\Entity
 */
class Dois
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
     * @var boolean
     *
     * @ORM\Column(name="self", type="boolean", nullable=false)
     */
    private $self;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=25, nullable=false)
     */
    private $status;

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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="created_by", referencedColumnName="user_id")
     * })
     */
    private $createdBy;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="source_id", referencedColumnName="id")
     * })
     */
    private $source;

    /**
     * @var \Estimations
     *
     * @ORM\ManyToOne(targetEntity="Estimations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="estimation_id", referencedColumnName="id")
     * })
     */
    private $estimation;

    /**
     * @var \Projects
     *
     * @ORM\ManyToOne(targetEntity="Projects")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="project_id", referencedColumnName="id")
     * })
     */
    private $project;


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
     * Set self
     *
     * @param boolean $self
     * @return Dois
     */
    public function setSelf($self)
    {
        $this->self = $self;

        return $this;
    }

    /**
     * Get self
     *
     * @return boolean 
     */
    public function getSelf()
    {
        return $this->self;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Dois
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Dois
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
     * @return Dois
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
     * Set createdBy
     *
     * @param \Users $createdBy
     * @return Dois
     */
    public function setCreatedBy(Users $createdBy = null)
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

    /**
     * Set source
     *
     * @param \Terms $source
     * @return Dois
     */
    public function setSource(Terms $source = null)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return \Terms 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set estimation
     *
     * @param \Estimations $estimation
     * @return Dois
     */
    public function setEstimation(Estimations $estimation = null)
    {
        $this->estimation = $estimation;

        return $this;
    }

    /**
     * Get estimation
     *
     * @return \Estimations 
     */
    public function getEstimation()
    {
        return $this->estimation;
    }

    /**
     * Set project
     *
     * @param \Projects $project
     * @return Dois
     */
    public function setProject(Projects $project = null)
    {
        $this->project = $project;

        return $this;
    }

    /**
     * Get project
     *
     * @return \Projects 
     */
    public function getProject()
    {
        return $this->project;
    }
}
