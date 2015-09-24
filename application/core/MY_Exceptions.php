<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class MY_Exceptions extends CI_Exceptions
{

	/**
	 * [$CI description]
	 * @var [type]
	 */
	private $CI;

	/**
	 * Class constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->CI =& get_instance();
	}


	public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
	{
		$templates_path = config_item('error_views_path');

		if (empty($templates_path))
		{
			$templates_path = VIEWPATH.'errors'.DIRECTORY_SEPARATOR;
		}

		if (is_cli())
		{
			$message = "\t".(is_array($message) ? implode("\n\t", $message) : $message);
			$template = 'cli'.DIRECTORY_SEPARATOR.$template;
		}
		else
		{
			set_status_header($status_code);
			$message = '<p>'.(is_array($message) ? implode('</p><p>', $message) : $message).'</p>';
			$template = 'html'.DIRECTORY_SEPARATOR.$template;
		}

		if (ob_get_level() > $this->ob_level + 1)
		{
			ob_end_flush();
		}

		switch ($status_code) {
			case '403':
				
		        $data['check_login'] = $loggedin = $this->CI->authentication->check_login( 1 );
		        $data['content'] = $this->CI->load->view('errors/forbidden', $data, TRUE);

		    	if (!$loggedin->user_id) {
		            echo $this->CI->load->view('html_anon', $data, true);
		    	}
		    	else {
		            echo $this->CI->load->view('html', $data, true);
		    	}



		    	exit;
			break;
			
			default:
					ob_start();
					include($templates_path.$template.'.php');
					$buffer = ob_get_contents();
					ob_end_clean();
				break;
		}

		return $buffer;
	}

}