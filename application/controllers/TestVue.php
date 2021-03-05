<?php defined('BASEPATH') or exit('Not found');

class TestVue extends CI_Controller{
    public function index(){
        $this->load->view('test_page.php');
    }
}