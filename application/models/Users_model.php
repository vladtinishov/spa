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
        $result = $this->db->query("SELECT COUNT(user_id) AS count_users FROM followers WHERE follower_id=$user_id");
        echo json_encode($result->result());
    }
    public function getSearchedUsers($user_name){
        $users = $this->db->query("SELECT users.user_id, users.user_name FROM users WHERE user_name = '$user_name'");
        echo json_encode($users->result());
    }
    public function getFollowedUsers($user_id){
        $follow = $this->db->query("SELECT follower_id FROM `followers` WHERE followers.user_id = $user_id");
        $result_array = [];
        foreach($follow->result() as $key => $data){
             array_push($result_array, $data->follower_id);
        }
        echo json_encode($result_array);
    }
    public function setFollower($user_id, $follower_id){
        $log = $this->db->query("INSERT INTO followers VALUES (NULL, $user_id, $follower_id)");
        echo json_encode($log);
    }
}