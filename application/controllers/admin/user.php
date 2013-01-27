<?php
/**
 * User controller. Manage the user models and user views.
 * User views can be found inside application/views/admin/main/user
 * user_model can be found inside application/models/admin/
 * @author Anton Zekeriev Rodin
 */
class User extends CI_Controller {
    
    /** 
     * Default contructor
     */
    public function __construct() {
        parent::__construct();
        $this->init_config();
    }

    /**
     * Load default view
     */
    public function index() {
        $this->list_user();
    }

    /**
     * Show user list. Get users from databse, set the pagination and load view
     * Check the user_model->get_users() for more description
     */
    public function list_user() {
        $this->load->model('admin/user_model');
        $this->data['title'] = 'User list';
        $this->data['query'] = $this->user_model->get_users();
        $this->data['suboption'] = 'sb-1';
        $this->data['load_view'] = 'user/list-user.php';
        $this->load->view('admin/main/main-template', $this->data);
    }

    /**
     * Show user form.
     */
    public function add_user_form() {
        $this->load->helper('form');
        $this->data['title'] = 'Add user form';
        $this->data['suboption'] = 'sb-2';
        $this->data['error'] = 'Fields marked with an asterisk are required';
        $this->data['load_view'] = 'user/add-user-form';
        $this->load->view('admin/main/main-template', $this->data);
    }

    /**
     * Add user. For more description look at user_model->add_user().
     */
    public function add_user() {
        $this->load->model('admin/user_model');
        $this->data['title'] = 'Add user form';
        $this->data['error'] = $this->user_model->add_user();
        $this->data['load_view'] = 'user/add-user-form';
        $this->load->view('admin/main/main-template', $this->data);
    }

    /**
     * Show form for user information
     * @param <Integer> $id User id
     */
    public function edit_user_form($id) {
            $this->load->model('admin/user_model');
            $this->data['title'] = 'Edit user form';
            $this->data['error'] = 'Fields marked with an asterisk are required';
            $this->data['id'] = $id;
            $this->data['submenu']['Edit user'] = 'admin/user/edit_user_form/' . $id . '';
            $this->data['suboption'] = 'sb-3';
            $this->data['result'] = $this->user_model->get_user($id);
            $this->data['load_view'] = 'user/edit-user-form';
            $this->load->view('admin/main/main-template', $this->data);
    }

    /**
     * Update user in the database. Check the user_model->update_user() for more description
     */
    public function update_user() {
        $this->load->helper('form');
        $this->load->model('admin/user_model');
        $this->data['title'] = 'Edit usser message';
        $this->data['error'] = $this->user_model->update_user();
        $this->data['load_view'] = 'error';
        $this->load->view('admin/main/main-template', $this->data);
    }

    public function reset_password_form($id = -1) {
        if ($id != -1) {
            $this->load->helper('form');
            $this->data['title'] = 'Reset user password';
            $this->data['id'] = $id;
            $this->data['submenu']['Reset password'] = 'admin/user/reset_password_form/' . $id . '';
            $this->data['suboption'] = 'sb-3';
            $this->data['error'] = '<p>The fields "password" and "confirm password" should be identical</p>';
            $this->data['load_view'] = 'user/reset-password-form';
            $this->load->view('admin/main/main-template', $this->data);
        } else {
            redirect(site_url('admin/user'));
        }
    }

    public function reset_password() {
        $this->load->model('admin/user_model');
        $this->data['error'] = $this->user_model->reset_password();
        $this->data['title'] = 'Reset password message';
        $this->data['load_view'] = 'error';
        $this->load->view('admin/main/main-template', $this->data);
    }

    /**
     * Callback function for the form validation. See user_model->username_check() for more description
     * @param <String> $username
     * @return <Boolean> fail check
     */
    public function username_check($username) {
        $this->load->model('admin/user_model');
        return $this->user_model->username_check($username);
    }

    /**
     * Callback function for the form validation. See user_model->email_check() for more description
     * @param <String> $email_address
     * @return <Boolean> fail check
     */
    public function email_check($email_address) {
        $this->load->model('admin/user_model');
        return $this->user_model->email_check($email_address);
    }

    /**
     * Callback function for form validation. Check the alphanumeric characters
     * @param <String> $username
     * @return <Boolean> Fail check 
     */
    public function username_ctype_check($username) {
        if (!ctype_alnum($username)) {
                $this->form_validation->set_message('username_ctype_check', 'The %s field only can be alphanumeric');
                return false;
        }
        return true;
    }

    /**
     * The password should be only alphanumeric characters
     * @param <String> $password Password string
     * @return <Boolean> return true whether alphanumeric, false otherwise 
     */
    public function password_ctype_check($password) {
        if (!ctype_alnum($password)) {
                $this->form_validation->set_message('password_ctype_check', 'The %s field should be only can be alphanumeric');
                return false;
        }
        return true;
    }

    /**
     * Delete user from database
     * @param <Integer> $id User ID 
     */
    public function delete_user($id) {
        $this->load->model('admin/user_model');
        $this->user_model->delete_user($id);
        redirect(site_url('admin/user/list_user'));
    }

    private function init_config() {
        $this->user_library->is_logged_in($this->session->userdata("is_logged_in"));
        
        $submenu = array(
            'User list' => 'admin/user/list_user',
            'Add user' => 'admin/user/add_user_form'
        );
        
        $this->menu_model->set_submenu($submenu);

        $this->data = array(
            'option' => 'op-2',
            'suboption' => 'sb-1',
            'mainmenu' => $this->menu_model->get_mainmenu(),
            'submenu' => $this->menu_model->get_submenu(),
            'title' => 'Clear Admin',
            'description' => 'Olive Line International S.L. cosmetics website management panel',
            'header' => 'header',
            'menu' => 'menu',
            'load_view' => 'user/list-user',
            'footer' => 'footer'
        );
    }

    private $data;
}