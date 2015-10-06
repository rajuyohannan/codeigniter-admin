<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estimations
 *
 * @ORM\Table(name="estimations", indexes={@ORM\Index(name="marketplace_id", columns={"marketplace_id"}), @ORM\Index(name="assigned_by", columns={"assigned_by"})})
 * @ORM\Entity
 */
class Estimations
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
     * @ORM\Column(name="title", type="string", length=255, nullable=false)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="schduled_on", type="datetime", nullable=false)
     */
    private $schduledOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_on", type="datetime", nullable=true)
     */
    private $updatedOn;

    /**
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="assigned_by", referencedColumnName="user_id")
     * })
     */
    private $assignedBy;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="marketplace_id", referencedColumnName="id")
     * })
     */
    private $marketplace;


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
     * Set title
     *
     * @param string $title
     * @return Estimations
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Estimations
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set schduledOn
     *
     * @param \DateTime $schduledOn
     * @return Estimations
     */
    public function setSchduledOn($schduledOn)
    {
        $this->schduledOn = $schduledOn;

        return $this;
    }

    /**
     * Get schduledOn
     *
     * @return \DateTime 
     */
    public function getSchduledOn()
    {
        return $this->schduledOn;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Estimations
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
     * @return Estimations
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
     * Set assignedBy
     *
     * @param \Users $assignedBy
     * @return Estimations
     */
    public function setAssignedBy(Users $assignedBy = null)
    {
        $this->assignedBy = $assignedBy;

        return $this;
    }

    /**
     * Get assignedBy
     *
     * @return \Users 
     */
    public function getAssignedBy()
    {
        return $this->assignedBy;
    }

    /**
     * Set marketplace
     *
     * @param \Terms $marketplace
     * @return Estimations
     */
    public function setMarketplace(Terms $marketplace = null)
    {
        $this->marketplace = $marketplace;

        return $this;
    }

    /**
     * Get marketplace
     *
     * @return \Terms 
     */
    public function getMarketplace()
    {
        return $this->marketplace;
    }
}
