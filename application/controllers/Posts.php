<?php defined('BASEPATH') or exit('Not found');
class Posts extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model');
    }
    public function index(){
        $this->load->view('index');
    }
    public function get_posts(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $user_id = intval($_POST['user_id']);
        $this->posts_model->getPosts($user_id);
    }
    public function set_posts(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $user_id = intval($_POST['user_id']);
        $content = $_POST['content'];
        $this->posts_model->setPosts($user_id, $content);
    }
    public function get_likes(){
        $_POST = json_decode(file_get_contents('php://input'), true);
        $user_id = $_POST['user_id'];
        $this->posts_model->getLikes($user_id);
    }
}