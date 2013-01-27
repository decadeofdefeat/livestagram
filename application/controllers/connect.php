<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Connect extends CI_Controller {

	
	public function index()
	{
		$this->load->library('instagram_api');

		redirect( $this->instagram_api->instagramLogin() );
	}
}
