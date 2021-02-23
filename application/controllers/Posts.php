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
    public function getPosts(){
        $posts_data = $this->posts_model->getPosts();
        return $posts_data;
    }
}