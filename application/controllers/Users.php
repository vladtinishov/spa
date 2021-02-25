<?php defined('BASEPATH') or exit('Not Found');

class Users extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
        $_POST = json_decode(file_get_contents('php://input'), true);
    }
    public function getUsers(){
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $this->users_model->getUsers($data);
    }
    public function set_reg_data(){
        $name = $_POST['reg_name'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $this->users_model->setRegData($name, $login, $password);
    }
    public function get_followers(){
        $user_id = $_POST['user_id'];
        $this->users_model->getFollowers($user_id);
    }
    public function get_searched_users(){
        $user_name = $_POST['user_name'];
        $this->users_model->getSearchedUsers($user_name);
    }
}