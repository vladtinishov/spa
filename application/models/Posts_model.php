<?php defined('BASEPATH') or exit('NOT FOUND');

class Posts_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    public function setPost(){
        $data = array(
            'user_id'=> $_POST['user_id'],
            'title'=>  $_POST['title'],
            'content'=>  $_POST['content'],
        );
        $this->db->insert('posts', $data);
    }
    public function getPosts(){
        $result = $this->db->get('posts');
        return $result->result_array();
    }
    
}