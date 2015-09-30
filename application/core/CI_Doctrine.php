<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

require_once APPPATH . 'libraries/Doctrine.php';

class MY_Doctrine extends Doctrine {
	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
	}
}