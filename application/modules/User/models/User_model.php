<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends MY_Model {

	/**
	 * [$em description]
	 * @var [type]
	 */
	var $em;

	/**
	 * Class Constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->em = $this->doctrine->em;
	}

	public function getUserName($uid = null) {
		if (!$uid)
			$uid = $this->auth_user_id;

		$user = $this->em->getRepository('Entity/Profiles')->findOneBy(array('user' => $uid));

		if ($user->getName()) {
			return $user->getName();
		}
		else {
			return $this->auth_user_name;
		}
		
	}

    /**
     * Load all terms by category
     * @return mixed    result
     */
    public function loadTermsByCategory($category = null) {
        $query = $this->em->createQuery("SELECT t.id, t.title FROM Entity\Terms t WHERE t.category = ?1 AND t.status = ?2");
        $query->setParameters(array(1 => $category, 2 => 1));
        $terms = $query->getResult();
        $result = array();
        foreach ($terms as $term) {
            $result[$term['id']] = $term['title'];
        }
        return $result;
    }

    /**
     * Load all terms by category
     * @return mixed    result
     */
    public function getUserSkills($uid) {

        $query = $this->em->createQuery("SELECT u FROM Entity\UserSkills u WHERE u.user = ?1");
        $query->setParameter(1, $uid);
        $terms = $query->getResult();
        
        $result = array();
        foreach ($terms as $term) {
            $result[$term->getTerm()->getId()] = $term->getTerm()->getTitle();
        }

        return $result;
    }


    /**
     * [getMaxWeight description]
     * @param  [type] $cid [description]
     * @return [type]      [description]
     */
    public function getMaxWeight($cid) {

        $dql = "SELECT MAX(t.weight) AS weight FROM Entity\Terms t " .
               "WHERE t.category = ?1";

        $weight = $this->em->createQuery($dql)
                        ->setParameter(1, $cid)
                        ->getSingleScalarResult();

        return $weight;

    }    

}