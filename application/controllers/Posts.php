<?php defined('BASEPATH') or exit('Not found');
class Posts extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('posts_model');
    }
    public function getPosts(){
        $data['data'] = $this->posts_model->getPosts();
        $this->load->view('index', $data);
    }
}