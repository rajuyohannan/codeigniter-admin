<?php


namespace Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Profiles
 *
 * @ORM\Table(name="profiles", indexes={@ORM\Index(name="user_id", columns={"user_id", "department"}), @ORM\Index(name="department", columns={"department"}), @ORM\Index(name="IDX_8B308530A76ED395", columns={"user_id"})})
 * @ORM\Entity
 */
class Profiles
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
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="datetime", nullable=true)
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="contact_number", type="string", length=255, nullable=true)
     */
    private $contactNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="text", length=65535, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="skills", type="text", length=65535, nullable=true)
     */
    private $skills;

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
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;

    /**
     * @var \Terms
     *
     * @ORM\ManyToOne(targetEntity="Terms")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="department", referencedColumnName="id")
     * })
     */
    private $department;


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
     * @return Profiles
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
     * Set dob
     *
     * @param \DateTime $dob
     * @return Profiles
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set contactNumber
     *
     * @param string $contactNumber
     * @return Profiles
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * Get contactNumber
     *
     * @return string 
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return Profiles
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set skills
     *
     * @param string $skills
     * @return Profiles
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;

        return $this;
    }

    /**
     * Get skills
     *
     * @return string 
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Profiles
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
     * @return Profiles
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
     * Set user
     *
     * @param \Users $user
     * @return Profiles
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
     * Set department
     *
     * @param \Terms $department
     * @return Profiles
     */
    public function setDepartment(Terms $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \Terms 
     */
    public function getDepartment()
    {
        return $this->department;
    }
}
