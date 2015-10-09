<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectDistribution
 *
 * @ORM\Table(name="project_distribution", indexes={@ORM\Index(name="project_id", columns={"project_id"}), @ORM\Index(name="technology_id", columns={"technology_id"})})
 * @ORM\Entity
 */
class ProjectDistribution
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
     * @var integer
     *
     * @ORM\Column(name="distribution", type="integer", nullable=false)
     */
    private $distribution;

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
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="technology_id", referencedColumnName="id")
     * })
     */
    private $technology;


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
     * Set distribution
     *
     * @param integer $distribution
     * @return ProjectDistribution
     */
    public function setDistribution($distribution)
    {
        $this->distribution = $distribution;

        return $this;
    }

    /**
     * Get distribution
     *
     * @return integer 
     */
    public function getDistribution()
    {
        return $this->distribution;
    }

    /**
     * Set project
     *
     * @param \Projects $project
     * @return ProjectDistribution
     */
    public function setProject(\Projects $project = null)
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

    /**
     * Set technology
     *
     * @param \Terms $technology
     * @return ProjectDistribution
     */
    public function setTechnology(\Terms $technology = null)
    {
        $this->technology = $technology;

        return $this;
    }

    /**
     * Get technology
     *
     * @return \Terms 
     */
    public function getTechnology()
    {
        return $this->technology;
    }
}
