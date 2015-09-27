<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @ORM\Table(name="users", uniqueConstraints={@ORM\UniqueConstraint(name="user_email", columns={"user_email"}), @ORM\UniqueConstraint(name="user_name", columns={"user_name"})})
 * @ORM\Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @ORM\Column(name="user_id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $userId;

    /**
     * @var string
     *
     * @ORM\Column(name="user_name", type="string", length=255, nullable=true)
     */
    private $userName;

    /**
     * @var string
     *
     * @ORM\Column(name="user_email", type="string", length=255, nullable=false)
     */
    private $userEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="user_pass", type="string", length=60, nullable=false)
     */
    private $userPass;

    /**
     * @var string
     *
     * @ORM\Column(name="user_salt", type="string", length=32, nullable=false)
     */
    private $userSalt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_last_login", type="datetime", nullable=true)
     */
    private $userLastLogin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_login_time", type="datetime", nullable=true)
     */
    private $userLoginTime;

    /**
     * @var string
     *
     * @ORM\Column(name="user_session_id", type="string", length=40, nullable=true)
     */
    private $userSessionId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_date", type="datetime", nullable=false)
     */
    private $userDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="user_modified", type="datetime", nullable=false)
     */
    private $userModified;

    /**
     * @var string
     *
     * @ORM\Column(name="user_agent_string", type="string", length=32, nullable=true)
     */
    private $userAgentString;

    /**
     * @var integer
     *
     * @ORM\Column(name="user_level", type="integer", nullable=false)
     */
    private $userLevel;

    /**
     * @var string
     *
     * @ORM\Column(name="user_banned", type="string", length=255, nullable=false)
     */
    private $userBanned;

    /**
     * @var string
     *
     * @ORM\Column(name="passwd_recovery_code", type="string", length=60, nullable=true)
     */
    private $passwdRecoveryCode;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="passwd_recovery_date", type="datetime", nullable=true)
     */
    private $passwdRecoveryDate;


    /**
     * Get userId
     *
     * @return integer 
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set userName
     *
     * @param string $userName
     * @return Users
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;

        return $this;
    }

    /**
     * Get userName
     *
     * @return string 
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * Set userEmail
     *
     * @param string $userEmail
     * @return Users
     */
    public function setUserEmail($userEmail)
    {
        $this->userEmail = $userEmail;

        return $this;
    }

    /**
     * Get userEmail
     *
     * @return string 
     */
    public function getUserEmail()
    {
        return $this->userEmail;
    }

    /**
     * Set userPass
     *
     * @param string $userPass
     * @return Users
     */
    public function setUserPass($userPass)
    {
        $this->userPass = $userPass;

        return $this;
    }

    /**
     * Get userPass
     *
     * @return string 
     */
    public function getUserPass()
    {
        return $this->userPass;
    }

    /**
     * Set userSalt
     *
     * @param string $userSalt
     * @return Users
     */
    public function setUserSalt($userSalt)
    {
        $this->userSalt = $userSalt;

        return $this;
    }

    /**
     * Get userSalt
     *
     * @return string 
     */
    public function getUserSalt()
    {
        return $this->userSalt;
    }

    /**
     * Set userLastLogin
     *
     * @param \DateTime $userLastLogin
     * @return Users
     */
    public function setUserLastLogin($userLastLogin)
    {
        $this->userLastLogin = $userLastLogin;

        return $this;
    }

    /**
     * Get userLastLogin
     *
     * @return \DateTime 
     */
    public function getUserLastLogin()
    {
        return $this->userLastLogin;
    }

    /**
     * Set userLoginTime
     *
     * @param \DateTime $userLoginTime
     * @return Users
     */
    public function setUserLoginTime($userLoginTime)
    {
        $this->userLoginTime = $userLoginTime;

        return $this;
    }

    /**
     * Get userLoginTime
     *
     * @return \DateTime 
     */
    public function getUserLoginTime()
    {
        return $this->userLoginTime;
    }

    /**
     * Set userSessionId
     *
     * @param string $userSessionId
     * @return Users
     */
    public function setUserSessionId($userSessionId)
    {
        $this->userSessionId = $userSessionId;

        return $this;
    }

    /**
     * Get userSessionId
     *
     * @return string 
     */
    public function getUserSessionId()
    {
        return $this->userSessionId;
    }

    /**
     * Set userDate
     *
     * @param \DateTime $userDate
     * @return Users
     */
    public function setUserDate($userDate)
    {
        $this->userDate = $userDate;

        return $this;
    }

    /**
     * Get userDate
     *
     * @return \DateTime 
     */
    public function getUserDate()
    {
        return $this->userDate;
    }

    /**
     * Set userModified
     *
     * @param \DateTime $userModified
     * @return Users
     */
    public function setUserModified($userModified)
    {
        $this->userModified = $userModified;

        return $this;
    }

    /**
     * Get userModified
     *
     * @return \DateTime 
     */
    public function getUserModified()
    {
        return $this->userModified;
    }

    /**
     * Set userAgentString
     *
     * @param string $userAgentString
     * @return Users
     */
    public function setUserAgentString($userAgentString)
    {
        $this->userAgentString = $userAgentString;

        return $this;
    }

    /**
     * Get userAgentString
     *
     * @return string 
     */
    public function getUserAgentString()
    {
        return $this->userAgentString;
    }

    /**
     * Set userLevel
     *
     * @param integer $userLevel
     * @return Users
     */
    public function setUserLevel($userLevel)
    {
        $this->userLevel = $userLevel;

        return $this;
    }

    /**
     * Get userLevel
     *
     * @return integer 
     */
    public function getUserLevel()
    {
        return $this->userLevel;
    }

    /**
     * Set userBanned
     *
     * @param string $userBanned
     * @return Users
     */
    public function setUserBanned($userBanned)
    {
        $this->userBanned = $userBanned;

        return $this;
    }

    /**
     * Get userBanned
     *
     * @return string 
     */
    public function getUserBanned()
    {
        return $this->userBanned;
    }

    /**
     * Set passwdRecoveryCode
     *
     * @param string $passwdRecoveryCode
     * @return Users
     */
    public function setPasswdRecoveryCode($passwdRecoveryCode)
    {
        $this->passwdRecoveryCode = $passwdRecoveryCode;

        return $this;
    }

    /**
     * Get passwdRecoveryCode
     *
     * @return string 
     */
    public function getPasswdRecoveryCode()
    {
        return $this->passwdRecoveryCode;
    }

    /**
     * Set passwdRecoveryDate
     *
     * @param \DateTime $passwdRecoveryDate
     * @return Users
     */
    public function setPasswdRecoveryDate($passwdRecoveryDate)
    {
        $this->passwdRecoveryDate = $passwdRecoveryDate;

        return $this;
    }

    /**
     * Get passwdRecoveryDate
     *
     * @return \DateTime 
     */
    public function getPasswdRecoveryDate()
    {
        return $this->passwdRecoveryDate;
    }
}
