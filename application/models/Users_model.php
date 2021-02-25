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
        $data = $result->row_array();
        echo json_encode($data);
    }
    public function setRegData($name, $login, $password){
        $result = $this->db->query("INSERT INTO users 
                            VALUES (NULL, '$name', '$login', '$password')");
        echo json_encode($result);
    }
    public function getFollowers($user_id){
        $result = $this->db->query("SELECT COUNT(users.user_name) AS count_users FROM users 
                                    INNER JOIN followers 
                                    ON 
                                    followers.user_id = $user_id 
                                    AND 
                                    followers.follower_id = users.user_id");
        echo json_encode($result->result());
    }
    public function getSearchedUsers($user_name){
        $result = $this->db->query("SELECT users.user_id, users.user_name FROM users WHERE user_name = '$user_name'");
        echo json_encode($result->result());
    }
}