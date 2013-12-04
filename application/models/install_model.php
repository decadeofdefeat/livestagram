<?php
/**
 * Installation model
 * @author Anton Zekeriev Rodin
 */
class Install_model extends CI_Model {

    public function  __construct() {}

    public function set_tables() {

        $query = '
            CREATE TABLE IF NOT EXISTS `instagram_users` (
                `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
                 `username` VARCHAR( 25 ) NOT NULL ,
                 `password` VARCHAR( 32 ) NOT NULL ,
                 `email_address` VARCHAR( 50 ) NOT NULL ,
                PRIMARY KEY (  `id` ) ,
                UNIQUE KEY  `email_address` (  `email_address` ) ,
                UNIQUE KEY  `username` (  `username` )
            ) ENGINE = MYISAM DEFAULT CHARSET = utf8;
            ';
        $this->db->query($query);


        $query = '
            CREATE TABLE IF NOT EXISTS `instagram_auth` (
                `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
                 `access_token` VARCHAR( 200 ) NOT NULL ,
                PRIMARY KEY (  `id` )
            ) ENGINE = MYISAM DEFAULT CHARSET = utf8;
            ';
        $this->db->query($query);

        $query = '
            CREATE TABLE IF NOT EXISTS `instagram_hashtag` (
                `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
                 `hashtag` VARCHAR( 200 ) NOT NULL ,
                PRIMARY KEY (  `id` )
            ) ENGINE = MYISAM DEFAULT CHARSET = utf8;
            ';
        $this->db->query($query);

        $query = '
            CREATE TABLE IF NOT EXISTS `instagram_feed` (
                `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
                 `media_id` VARCHAR( 200 ) NOT NULL ,
                `min_id` VARCHAR( 200 ) NOT NULL ,
                `url` TEXT NOT NULL ,
                `c_time` VARCHAR( 100 ) NOT NULL ,
                `add_time` VARCHAR( 100 ) NOT NULL ,
                `user` VARCHAR( 200 ) NOT NULL ,
                `user_pic` VARCHAR( 200 ) NOT NULL ,
                `caption` TEXT NOT NULL ,
                `link` VARCHAR( 200 ) NOT NULL ,
                `low_res` TEXT NOT NULL ,
                `thumb` TEXT NOT NULL ,
                `banned` INT(11) NOT NULL ,
                PRIMARY KEY (  `id` )
            ) ENGINE = MYISAM DEFAULT CHARSET = utf8;
            ';
        $this->db->query($query);

    }

    public function set_users() {

        $insert_data = array(
            'username' => 'admin',
            'password' => md5('password'),
            'email_address' => 'joe@email.com'
        );
        $this->db->insert('instagram_users', $insert_data);

    }

}
?>
