<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Poll extends CI_Controller {


	public function get_new_photos()
	{
		$this->load->model( 'subscribe_model' );

		// call function to start polling with 2 minute delay

		echo json_encode( array(
       	 'photos' => $this->subscribe_model->start_polling(  ),
       	 // response again the server time to update the "js time variable"
       	 'timestamp' => time()
    	) );
	}


	public function admin_get_new_photos()
	{
		$this->load->model( 'subscribe_model' );

		// call function to start polling with NO delay

		echo json_encode( array(
       	 'photos' => $this->subscribe_model->admin_start_polling(  ),
       	 // response again the server time to update the "js time variable"
       	 'timestamp' => time()
    	) );
	}




}

