<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Likes
 *
 * @ORM\Table(name="likes", indexes={@ORM\Index(name="created_by", columns={"created_by"}), @ORM\Index(name="articles_id", columns={"articles_id"})})
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
     * @var \DateTime
     *
     * @ORM\Column(name="created_on", type="datetime", nullable=false)
     */
    private $createdOn;

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
     * @var \Articles
     *
     * @ORM\ManyToOne(targetEntity="Articles")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="articles_id", referencedColumnName="id")
     * })
     */
    private $articles;


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
     * @param \DateTime $createdOn
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
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
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

    /**
     * Set articles
     *
     * @param \Articles $articles
     * @return Likes
     */
    public function setArticles(\Articles $articles = null)
    {
        $this->articles = $articles;

        return $this;
    }

    /**
     * Get articles
     *
     * @return \Articles 
     */
    public function getArticles()
    {
        return $this->articles;
    }
}
