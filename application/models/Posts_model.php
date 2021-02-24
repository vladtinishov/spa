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
    public function getPosts($id){
        $result = $this->db->query("SELECT 
                                    post_date, content, users.user_name 
                                    FROM posts 

                                    INNER JOIN followers 
                                    ON 
                                    followers.user_id = $id
                                    AND 
                                    posts.user_id = followers.follower_id 
        
                                    INNER JOIN users 
                                    ON 
                                    posts.user_id = users.user_id
                                    ");
        echo json_encode($result->result());
    }
    
    
}