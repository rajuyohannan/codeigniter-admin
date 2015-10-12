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

        $dql = "SELECT p.name,u.userName FROM Entity\Profiles p JOIN p.user u WHERE p.user = ?1";
		$user = $this->em->createQuery($dql)->setParameter(1, $uid)->getArrayResult();

        $name = $user[0]['name'];
        if (!$name) {
            $name = $user[0]['userName'];
        }
        return $name;
	}

    /**
     * [loadCategories description]
     * @return [type] [description]
     */
    public function loadCategories() {
        $query = $this->em->createQuery("SELECT c.id, c.title FROM Entity\Categories c")->getResult();

        $result = array();
        foreach($query as $key => $category) {
            $result[$query[$key]['id']] = $query[$key]['title'];
        }

        return $result;

    }

    /**
     * Load all terms by category
     * @return mixed    result
     */
    public function loadTermsByCategory($category = null) {

        if (!is_numeric($category)) {
            $category = $this->em->createQuery("SELECT c.id FROM Entity\Categories c WHERE c.title = :title")->setParameter(':title', $category)->getResult()[0]['id'];
        }

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


    /**
     * [getMasterCategories description]
     * @return [type] [description]
     */
    public function getMasterCategories() {

        $dql = "SELECT c.id as catid, m.title mcatid FROM Entity\Categories c, Entity\MasterCategories m JOIN m.category mc WHERE c.id=mc";

        $result = $this->em->createQuery($dql)->getArrayResult();

        $return = array();

        foreach ($result as $terms) {
            $return[$terms['mcatid']] = array(
                    'catid' => $terms['catid'],
                );
        }
        return $return;
    }

    /**
     * [getMasterTerms description]
     * @param  array  $category [description]
     * @return [type]           [description]
     */
    public function getMasterTerms($category = array()) {
        $masterCategory = $this->getMasterCategories();

        $return = array();
        foreach ($category as $key => $value) {
            $id = $masterCategory[$value]['catid'];
            $dql = "SELECT t FROM Entity\Terms t WHERE t.category = ?1";
            $result = $this->em->createQuery($dql)->setParameter(1,$id)->getArrayResult();

            foreach ($result as $term) {
                $return[$value][$term['id']] = $term['title'];
            }
        }
        
        return $return;
    }

     /**
      * [getUserByRoles description]
      * @param  array  $roles [description]
      * @return  [type]        [description]
      */
    public function getUserByRoles($roles = array()) {

        $allRoles = $this->config->item('levels_and_roles');
        $return = array();

        foreach ($roles as $key => $value) {
            $roleid = array_search($value, $allRoles);
            $dql = "SELECT p, u FROM Entity\Profiles p JOIN p.user u WHERE u.userLevel = ?1 ";
            $result = $this->em->createQuery($dql)->setParameter(1, $roleid)->getArrayResult();

            foreach ($result as $user) {
                $return[$user['user']['userId']] = $this->getUserName($user['user']['userId']);
            }
        }
        return $return;
    }

    /**
     * [getUserProfile description]
     * @param  [type] $uid [description]
     * @return [type]      [description]
     */
    public function getUserProfile($uid = null) {
        $dql = "SELECT p, u FROM Entity\Profiles p JOIN p.user u WHERE p.user = ?1 ";
        $result = $this->em->createQuery($dql)->setParameter(1, $uid)->getArrayResult();

        return $result[0];
    }

    public function getAssignedBy($entity, $field) {

        $dql = "SELECT DISTINCT(e.$field) FROM $entity e";
        $result = $this->em->createQuery($dql)->getArrayResult();
        $return = array();
        foreach ($result as $assignedby) {
            $return[$assignedby[1]] = $this->getUserName($assignedby[1]);
        }

        return $return;
    }

    public function getAssignedTo($entity) {
        return $return;
    }
}