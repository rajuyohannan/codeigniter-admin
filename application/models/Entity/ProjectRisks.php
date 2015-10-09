<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * ProjectRisks
 *
 * @ORM\Table(name="project_risks", indexes={@ORM\Index(name="project_id", columns={"project_id"}), @ORM\Index(name="created_by", columns={"created_by"})})
 * @ORM\Entity
 */
class ProjectRisks
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
     * @ORM\Column(name="description", type="text", length=65535, nullable=false)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="mitigation_plan", type="text", length=65535, nullable=false)
     */
    private $mitigationPlan;

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
     * Set description
     *
     * @param string $description
     * @return ProjectRisks
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
     * Set mitigationPlan
     *
     * @param string $mitigationPlan
     * @return ProjectRisks
     */
    public function setMitigationPlan($mitigationPlan)
    {
        $this->mitigationPlan = $mitigationPlan;

        return $this;
    }

    /**
     * Get mitigationPlan
     *
     * @return string 
     */
    public function getMitigationPlan()
    {
        return $this->mitigationPlan;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return ProjectRisks
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
     * @return ProjectRisks
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
     * Set project
     *
     * @param \Projects $project
     * @return ProjectRisks
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
}
