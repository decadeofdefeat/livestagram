<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function index()
	{
		$this->load->model( 'Subscribe_model' );
		$pageData['photos'] = $this->Subscribe_model->list_all();

		$pageData['hashtag'] = $this->Subscribe_model->get_hashtag();

		$this->load->view('welcome_message', $pageData);
	}
}
