<?php

class User_model extends CI_model
{
    /*
    Register and insert user in database.
    args: array of user info.
    */
    public function register($user)
    {
        if ($this->db->insert('user', $user)) {
            return true;
        } else {
            return false;
        }
    }

    /*
    Check if user exist or not via email.
    args: email you want to check
    */
    public function emailCheck($email)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return true;
        }
    }

    /*
    To login user , check input data and giv sutaible message
    args: email and password
    */
    public function loginUser($email, $password)
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('user_email', $email);
        $this->db->where('user_password', $password);
        if ($query = $this->db->get()) {
            return $query->row_array();
        } else {
            return false;
        }
    }

}
