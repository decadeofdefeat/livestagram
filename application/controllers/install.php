<?php
/**
 * Install controller
 * @author Anton Zekeriev Rodin
 */
class Install extends CI_Controller {

    public function  __construct() {
        parent::__construct();
    }

    public function index() {
        $this->install();
    }

    public function install() {
        $this->load->database();
        $this->load->model('install_model');
        $this->install_model->set_tables();
        $this->install_model->set_users();
    }
}
?>
