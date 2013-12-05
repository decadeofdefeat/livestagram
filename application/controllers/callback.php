<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Callback extends CI_Controller {

	public function  __construct() {
        parent::__construct();
        $this->load->model( 'subscribe_model');
    }

	public function get_token()
	{
		$min_id = $this->subscribe_model->get_access_token();
	}

	public function test()
	{
		echo "Token is ".$this->subscribe_model->get_access_token();
	}

	public function redirect_uri()
	{

		if(isset($_GET['code']) && $_GET['code'] != '') {

			$this->load->library('instagram_api');

			$auth_response = $this->instagram_api->authorize($_GET['code']);


			if( isset($auth_response->access_token) )
			{

				$oauth_data = array(
					'access_token' => $auth_response->access_token,
				);

				$this->subscribe_model->set_access_token( $oauth_data );

				// Set the instagram library access token variable
				$this->instagram_api->access_token = $this->subscribe_model->get_access_token();

				// redirect to main page
				redirect('/welcome');

			}
			else
			{
			
				// Error of 400 or something else
				 echo $auth_response->error_type;
    			 echo (isset($auth_response->error_message) ? ': '.$auth_response->error_message : '');
			}


		}
		else
		{
			print "failed?";
		}
	}



	public function index()
	{

		$pageData['challenge'] = '';

		if( isset($_GET['hub_challenge']))
		{
			// echo challenge when you first Subscribe to Instagram
			$pageData['challenge'] = $_GET['hub_challenge'];
			echo $pageData['challenge'];
		}
		else
		{

			$this->load->library('instagram_api');

			// Write to activity.log to make sure its working
			$myString = file_get_contents('php://input');
			$ALL = date("F j, Y, g:i a")." ".$myString."\r\n";
			file_put_contents('activity.log', $ALL, FILE_APPEND);

			$this->instagram_api->access_token = $this->subscribe_model->get_access_token();

			$min_id = null;
			$next_min_id = '';

			$min_id = $this->subscribe_model->min_id();

			$hashtag = $this->subscribe_model->get_hashtag( );

			$tags = $this->instagram_api->tagsRecent( $hashtag, '', $min_id );


			if ( $tags ) {

				if ( property_exists( $tags->pagination, 'min_tag_id' ) ) {
					$next_min_id = $tags->pagination->min_tag_id;
				}

				foreach ( $tags as $tag ) {

					if ( is_array( $tag ) ) {

						foreach ( $tag as $media ) {

							$url = $media->images->standard_resolution->url;
							$m_id = $media->id;
							$c_time = $media->created_time;
							$user = $media->user->username;

							$profile_pic = $media->user->profile_picture;


							$caption = $media->caption->text;
							$link = $media->link;
							$low_res=$media->images->low_resolution->url;
							$thumb=$media->images->thumbnail->url;

							// other data you can retrieve if you'd like
							// I didn't need them so I commented them out

							//$filter = $media->filter;
							//$comments = $media->comments->count;
							//$lat = $media->location->latitude;
							//$long = $media->location->longitude;
							//$loc_id = $media->location->id;

							$data = array(
								'media_id' => $m_id,
								'min_id' => $next_min_id,
								'url' => $url,
								'c_time' => $c_time,
								'add_time' => time(),
								'user' => $user,
								'user_pic' => $profile_pic,
								'caption' => $caption,
								'link' => $link,
								'low_res' => $low_res,
								'thumb' => $thumb,
								'banned' => '0',

								// other data you can add to the database if you like
								// I didn't need them so I commented them out

								//'filter' => $filter,
								//'comment_count' => $comments,
								//'lat' => $lat,
								//'long' => $long,
								//'loc_id' => $loc_id,
							);

							$this->subscribe_model->add_tag( $data );


						}

					}

				}
			}
		}

	}

}

