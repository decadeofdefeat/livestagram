<?php

/**
 * User model. Manage all data for update, delete, insert and other stuff like queries, validate forms, check unique fields...
 */
class User_model extends CI_Model {

    public function  __construct() {
        parent::__construct();
        $this->init_config();
    }

    /**
     * Get query with users from database
     * @return <Array> Return array query result.
     */
    public function get_users() {
        
        //Pagination
        $this->load->library('pagination');
        $config['base_url'] = base_url('admin/user/list_user');
        $config['total_rows'] = $this->db->count_all('instagram_users');
        $config['per_page'] = 8;
        $config['uri_segment'] = 4;
        $config['num_links'] = 5;
        $config['full_tag_open'] = '<div class="pagination">';
        $config['full_tag_close'] = '</div>';
        $this->pagination->initialize($config);

        $this->db->order_by('id', 'desc');
        $query = $this->db->get('instagram_users', $config['per_page'], $this->uri->segment(4));
        return $query;
    }

    /**
     * Return user data
     * @param <stdClass> Return stdClass that have the user data
     */
    public function get_user($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('instagram_users');
        return array_pop($query->result());
    }

    /**
     * Add user to the database. Perform some validation like trim, htmlspecialchars, valid email, db unique fields...
     * @return <String> Error or Message
     */
    public function add_user() {

        $error = '<p></p>';
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->add_rules);
        
        if ($this->form_validation->run() == false) {
            $error = validation_errors();
        } else {

            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email_address = $this->input->post('email_address');

            $insert_data = array(
                'username' => $username,
                'password' => md5($password),
                'email_address' => $email_address
            );

            $this->db->insert('instagram_users',$insert_data);
            $error = "<p>User succefully inserted</p>";
        }
        
        return $error;
    }

    /**
     * Update user entry. It perform some validation for example trim, htmlspceialchars, valid email and the unique rows
     * @return <String> Error message 
     */
    public function update_user() {

        $error = '<p></p>';
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->update_rules);

        if ($this->form_validation->run() == false) {
            $error = validation_errors();
        } else {

            $id = $this->input->post('id');
            $username = $this->input->post('username');
            $email_address = $this->input->post('email_address');
            
            if ($this->check_username_update($username, $id)) {
                $error = "<p>$username already exists</p>";
            } else if ($this->check_email_address_update($email_address, $id)) {
                $error = "<p>$email_address already exists</p>";
            } else {
                
                $update_data = array(
                    'username' => $username,
                    'email_address' => $email_address
                );

                $this->db->where('id', $id);
                $this->db->update('instagram_users', $update_data);
                $error = '<p>User successfully updated</p>';
            }
        }

        return $error;
    }

    /**
     * Check the password and update the record.
     * @return <String> Error message.
     */
    public function reset_password() {
        $error = '<p></p>';
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->password_rules);
        if($this->form_validation->run() == false) {
            $error = validation_errors();
        } else {
            $insert_data = array(
                'password' => md5($this->input->post('password'))
            );
            $this->db->where('id', $this->input->post('id'));
            $this->db->update('instagram_users', $insert_data);
            $error = '<p>User password succefully reseted</p>';
        }
        return $error;
    }

    /**
     * Check if there other user name with the same username
     * @param <String> $username check if exists user with the same username and distinc ID
     * @param <Integer> $id ID of the current username
     * @return <Boolean> Return true if found same username and different ID
     */
    public function check_username_update($username, $id) {

        $this->db->where('id !=', $id);
        $this->db->where('username', $username);
        $query = $this->db->get('instagram_users');

        if( $query->num_rows == 0 ) {
            return false;
        } else {
            return true;
        }
        
    }

    /**
     * Check if there other user name with the same email address
     * @param <String> $username check if exists user with the same email address and distinc ID
     * @param <Integer> $id ID of the current username
     * @return <Boolean> Return true if found same email address and different ID
     */
     public function check_email_address_update($email_address, $id) {

        $this->db->where('id !=', $id);
        $this->db->where('email_address', $email_address);
        $query = $this->db->get('instagram_users');

        if( $query->num_rows == 0 ) {
            return false;
        } else {
            return true;
        }

    }

    /**
     * Check the username. Alfanumeric characters and if existe same username in the DB
     * @param <String> $username
     * @return <Boolean> true if all ok. False if found other user with same name or it not alphanumeric 
     */
    public function username_check($username) {
        $this->db->where('username', $username);
        $query = $this->db->get('instagram_users');
        if ($query->num_rows == 0) {
            if (ctype_alnum($username)) {
                return true;
            } else {
                $this->form_validation->set_message('username_check', 'The %s field only can be alphanumeric');
            return false;
            }
        } else {
            $this->form_validation->set_message('username_check', 'The %s record already exists in the database');
            return false;
        }
    }

    /**
     * Check the username. Check for the same email in the DB
     * @param <String> $email
     * @return <Boolean> true if all ok. False if found other user with same email
     */
    public function email_check($email_address) {
        $this->db->where('email_address', $email_address);
        $query = $this->db->get('instagram_users');
        if ($query->num_rows == 0) {
            return true;
        } else {
            $this->form_validation->set_message('email_check', 'The %s record already exists in the database');
            return false;
        }
    }

    /**
     * Delete user from database
     * @param <Integer> $id User Id 
     */
    function delete_user($id) {
        $this->db->where('id', $id);
        $this->db->delete('instagram_users');
    }

    /**
     * Check if there username and the password in the DB
     * @param <String> $username
     * @param <String> $password
     * @return <Boolean> user exists in the DB and the password matches
     */
    function validate($username, $password) {
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get('instagram_users');

        if ($query->num_rows == 1) {
            return true;
        }
    }

    private function init_config() {

        $this->update_rules = array(
            array(
                'field' => 'username',
                'label' => 'User name',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]|callback_username_ctype_check'
            ),
            array(
                'field' => 'email_address',
                'label' => 'Email Address',
                'rules' => 'trim|htmlspecialchars|required|valid_email'
            )
        );

        $this->add_rules = array(
            array(
                'field' => 'username',
                'label' => 'User name',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]|callback_username_check'
            ),
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]|matches[confirm_password]'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]|callback_password_ctype_check'
            ),
            array(
                'field' => 'email_address',
                'label' => 'Email Address',
                'rules' => 'trim|htmlspecialchars|required|valid_email|callback_email_check'
            )
        );

        $this->password_rules = array(
            array(
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]|matches[confirm_password]|callback_password_ctype_check'
            ),
            array(
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'trim|htmlspecialchars|required|max_length[25]'
            )
        );
    }

    private $add_rules;
    private $update_rules;
    private $password_rules;
}
?>