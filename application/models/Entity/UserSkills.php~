<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserSkills
 *
 * @ORM\Table(name="user_skills", indexes={@ORM\Index(name="term_id", columns={"term_id"}), @ORM\Index(name="user_id", columns={"user_id"})})
 * @ORM\Entity
 */
class UserSkills
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
     * @var \Users
     *
     * @ORM\ManyToOne(targetEntity="Users")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="term_id", referencedColumnName="id")
     * })
     */
    private $term;


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
     * Set user
     *
     * @param \Users $user
     * @return UserSkills
     */
    public function setUser(Users $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \Users 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set term
     *
     * @param \Terms $term
     * @return UserSkills
     */
    public function setTerm(Terms $term = null)
    {
        $this->term = $term;

        return $this;
    }

    /**
     * Get term
     *
     * @return \Terms 
     */
    public function getTerm()
    {
        return $this->term;
    }


    public function getAllTerms() {
        
    }

}
