<?php

/*
|--------------------------------------------------------------------------
| Instagram
|--------------------------------------------------------------------------
|
| Instagram client details
|
*/

$config['instagram_client_name']	= 'Movi Live Feed';
$config['instagram_client_id']		= 'd7ba4d21185140b6a7df072ca830a304';
$config['instagram_client_secret']	= '35fe76e8f8424d76a1a5cb306114e6db';
$config['instagram_callback_url']	= 'http://movi.org/livestagram/callback/redirect_uri/';
$config['instagram_website']		= 'http://movi.org/livestagram/';
$config['instagram_description']	= '';


// delete all objects
//https://api.instagram.com/v1/subscriptions?client_secret=35fe76e8f8424d76a1a5cb306114e6db&object=all&client_id=d7ba4d21185140b6a7df072ca830a304

// There was issues with some servers not being able to retrieve the data through https
// If you have this problem set the following to FALSE 
// See https://github.com/ianckc/CodeIgniter-Instagram-Library/issues/5 for a discussion on this
$config['instagram_ssl_verify']		= FALSE;