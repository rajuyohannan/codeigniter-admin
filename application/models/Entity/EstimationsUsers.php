<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EstimationsUsers
 *
 * @ORM\Table(name="estimations_users", indexes={@ORM\Index(name="estimation_id", columns={"estimation_id"}), @ORM\Index(name="assigned_to", columns={"assigned_to"})})
 * @ORM\Entity
 */
class EstimationsUsers
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
     * @ORM\Column(name="data", type="text", length=65535, nullable=false)
     */
    private $data;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255, nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="started_on", type="datetime", nullable=false)
     */
    private $startedOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="completed_on", type="datetime", nullable=false)
     */
    private $completedOn;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="assigned_to", referencedColumnName="user_id")
     * })
     */
    private $assignedTo;

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
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return EstimationsUsers
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

    /**
     * Set status
     *
     * @param string $status
     * @return EstimationsUsers
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
     * Set startedOn
     *
     * @param \DateTime $startedOn
     * @return EstimationsUsers
     */
    public function setStartedOn($startedOn)
    {
        $this->startedOn = $startedOn;

        return $this;
    }

    /**
     * Get startedOn
     *
     * @return \DateTime 
     */
    public function getStartedOn()
    {
        return $this->startedOn;
    }

    /**
     * Set completedOn
     *
     * @param \DateTime $completedOn
     * @return EstimationsUsers
     */
    public function setCompletedOn($completedOn)
    {
        $this->completedOn = $completedOn;

        return $this;
    }

    /**
     * Get completedOn
     *
     * @return \DateTime 
     */
    public function getCompletedOn()
    {
        return $this->completedOn;
    }

    /**
     * Set assignedTo
     *
     * @param \Users $assignedTo
     * @return EstimationsUsers
     */
    public function setAssignedTo(\Users $assignedTo = null)
    {
        $this->assignedTo = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return \Users 
     */
    public function getAssignedTo()
    {
        return $this->assignedTo;
    }

    /**
     * Set estimation
     *
     * @param \Estimations $estimation
     * @return EstimationsUsers
     */
    public function setEstimation(\Estimations $estimation = null)
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
}
