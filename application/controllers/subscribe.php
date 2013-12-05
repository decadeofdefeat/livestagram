<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subscribe extends CI_Controller {


	public function index()
	{

		$data = array();
		$data['results'] = null;

		if($this->input->post('hashtag'))
		{
	
			$this->load->model( 'subscribe_model' );
			$this->load->library('instagram_api');
			$this->load->config('Instagram_api');

			
			//ALL YOUR IMPORTANT API INFO
			$client_id = $this->config->item('instagram_client_id');
			$client_secret = $this->config->item('instagram_client_secret');
			$object = 'tag';
			$object_id = $this->input->post('hashtag');
			$aspect = 'media';
			$verify_token='';

			$callback_url = $this->config->item('website_callback_url');



			//SETTING UP THE CURL SETTINGS...
			$attachment =  array(
			'client_id' => $client_id,
			'client_secret' => $client_secret,
			'object' => $object,
			'object_id' => $object_id,
			'aspect' => $aspect,
			'verify_token' => $verify_token,
			'callback_url'=>$callback_url
			);

			//URL TO THE INSTAGRAM API FUNCTION
			$url = "https://api.instagram.com/v1/subscriptions/";

			
			$ch = curl_init();

			//EXECUTE THE CURL...
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $attachment);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);  //to suppress the curl output 
			$result = curl_exec($ch);
			curl_close ($ch);

			$json = stripslashes($result);
			$json = json_decode($json);

			
			if( $json->meta->code == '200')
			{

				$data =  array(
					'hashtag' => $this->input->post('hashtag')
				);

				$this->subscribe_model->set_hashtag( $data );

				// success!
				// go to home page now.
				redirect('/welcome');
			}
			else
			{
				// fail...
				$data['results'] = "Something went wrong, you returned an error from Instagram API - ".$result ;
				$this->load->view('subscribe', $data);
			}
			
		}
		else
		{
			$this->load->view('subscribe', $data);
		}

		
	}

	


	
	
}

