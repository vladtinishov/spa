<?php defined('BASEPATH') or exit('not found');

class Users_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    public function getUsers($data){
        $login = $data['login'];
        $password = $data['password'];
        $result = $this->db->query("SELECT * FROM users 
                                    WHERE 
                                    user_login = '$login' 
                                    AND 
                                    user_password = '$password'
                                    ");
        echo json_encode($result->result());
    }
}