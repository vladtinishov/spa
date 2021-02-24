<?php defined('BASEPATH') or exit('Not found');
class Posts extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model');
        $_POST = json_decode(file_get_contents('php://input'), true);
    }
    public function index(){
        $this->load->view('index');
    }
    public function get_posts(){
        $user_id = intval($_POST['user_id']);
        $this->posts_model->getPosts($user_id);
    }
    public function set_posts(){
        $user_id = intval($_POST['user_id']);
        $content = $_POST['content'];
        $this->posts_model->setPosts($user_id, $content);
    }
    public function get_likes(){
        $user_id = $_POST['user_id'];
        $this->posts_model->getLikes($user_id);
    }
    public function set_like(){
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $this->posts_model->setLike($user_id, $post_id);
    }
    public function delete_like(){
        $user_id = $_POST['user_id'];
        $post_id = $_POST['post_id'];
        $this->posts_model->deleteLike($user_id, $post_id);
    }
}