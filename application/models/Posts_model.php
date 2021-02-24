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
                                    post_id, post_date, content, users.user_name 
                                    FROM posts 

                                    INNER JOIN followers 
                                    ON 
                                    followers.user_id = $id
                                    AND 
                                    posts.user_id = followers.follower_id 
        
                                    INNER JOIN users 
                                    ON 
                                    posts.user_id = users.user_id
                                    ORDER BY post_date DESC
                                    ");
        echo json_encode($result->result());
    }
    public function setPosts($id, $content){
        $date = date("Y-m-d H:i:s");
        $result = $this->db->query("INSERT INTO posts 
                                    VALUES(
                                        NULL,
                                        $id,
                                        '$content',
                                        '$date'
                                        )
                                    ");
        echo var_dump($result);
    }
    public function getLikes($id){
        $result = $this->db->query("SELECT post_id FROM likes WHERE user_id = $id");
        $res = [];
        foreach($result->result() as $key => $data){
             array_push($res, $data->post_id);
        }
        echo json_encode($res);
    }
    
}