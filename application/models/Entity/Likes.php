<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="pid", columns={"pid"}), @ORM\Index(name="created_by", columns={"created_by"})})
 * @ORM\Entity
 */
class Likes
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
     * @ORM\Column(name="created_on", type="integer", nullable=false)
     */
    private $createdOn;

    /**
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="pid", referencedColumnName="id")
     * })
     */
    private $pid;

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
     * Set createdOn
     *
     * @param integer $createdOn
     * @return Likes
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;

        return $this;
    }

    /**
     * Get createdOn
     *
     * @return integer 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set pid
     *
     * @param \Articles $pid
     * @return Likes
     */
    public function setPid(\Articles $pid = null)
    {
        $this->pid = $pid;

        return $this;
    }

    /**
     * Get pid
     *
     * @return \Articles 
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * Set createdBy
     *
     * @param \Users $createdBy
     * @return Likes
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
