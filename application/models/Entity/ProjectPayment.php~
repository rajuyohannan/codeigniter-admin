<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectPayment
 *
 * @ORM\Table(name="project_payment", indexes={@ORM\Index(name="project_id", columns={"project_id"})})
 * @ORM\Entity
 */
class ProjectPayment
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
     * @ORM\Column(name="amount_head", type="string", length=255, nullable=false)
     */
    private $amountHead;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount_received", type="integer", nullable=false)
     */
    private $amountReceived;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="received_on", type="datetime", nullable=false)
     */
    private $receivedOn;

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
     * Set amountHead
     *
     * @param string $amountHead
     * @return ProjectPayment
     */
    public function setAmountHead($amountHead)
    {
        $this->amountHead = $amountHead;

        return $this;
    }

    /**
     * Get amountHead
     *
     * @return string 
     */
    public function getAmountHead()
    {
        return $this->amountHead;
    }

    /**
     * Set amountReceived
     *
     * @param integer $amountReceived
     * @return ProjectPayment
     */
    public function setAmountReceived($amountReceived)
    {
        $this->amountReceived = $amountReceived;

        return $this;
    }

    /**
     * Get amountReceived
     *
     * @return integer 
     */
    public function getAmountReceived()
    {
        return $this->amountReceived;
    }

    /**
     * Set receivedOn
     *
     * @param \DateTime $receivedOn
     * @return ProjectPayment
     */
    public function setReceivedOn($receivedOn)
    {
        $this->receivedOn = $receivedOn;

        return $this;
    }

    /**
     * Get receivedOn
     *
     * @return \DateTime 
     */
    public function getReceivedOn()
    {
        return $this->receivedOn;
    }

    /**
     * Set project
     *
     * @param \Projects $project
     * @return ProjectPayment
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
