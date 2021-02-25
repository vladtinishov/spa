<?php defined('BASEPATH') or exit('Not Found');

class Users extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('users_model');
    }
    public function getUsers(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $data['login'] = $_POST['login'];
        $data['password'] = $_POST['password'];
        $this->users_model->getUsers($data);

    }
    public function set_reg_data(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $name = $_POST['reg_name'];
        $login = $_POST['login'];
        $password = $_POST['password'];
        $this->users_model->setRegData($name, $login, $password);
    }
}