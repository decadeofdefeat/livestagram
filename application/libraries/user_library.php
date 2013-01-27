<?php

/**
 * User library for manage roles, user sessions, cookies
 * @author Anton Zekeriev Rodin
 */
class User_library {

    public function  __construct() {
    }

    public function is_logged_in($is_logged_in) {
        if (!isset($is_logged_in) || $is_logged_in !== true) {
            redirect(site_url() . "admin/login/");
            die();
        }
    }

}