<?php defined('BASEPATH') or exit('NOT FOUND');

class Posts_model extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    public function getPosts($id){
        $result = $this->db->query("SELECT 
                                    likes, post_id, post_date, content, users.user_name, posts.user_id 
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
                                        '$date',
                                        0
                                        )
                                    ");
        echo var_dump($result);
    }

    public function getLikes($id){
        $result = $this->db->query("SELECT post_id FROM likes WHERE user_id = $id");
        $result_array = [];
        foreach($result->result() as $key => $data){
             array_push($result_array, $data->post_id);
        }
        echo json_encode($result_array);
    }

    public function setLike($user_id, $post_id){
        $this->db->query("INSERT INTO likes 
                                    VALUES (
                                        $user_id,
                                        $post_id
                                        )");
        $this->db->query("UPDATE posts 
                        SET likes = likes + 1 
                        WHERE post_id = $post_id");
    }

    public function deleteLike($user_id, $post_id){
        $this->db->query("DELETE FROM likes WHERE 
                                    user_id=$user_id AND post_id=$post_id
                                    ");
        $this->db->query("UPDATE posts 
                        SET likes = likes - 1 
                        WHERE post_id = $post_id");
    }

    public function getSinglePost($post_id){
        $posts = $this->db->query("SELECT * FROM posts 
                                                WHERE post_id = $post_id");

        $users = $this->db->query("SELECT users.user_name, users.user_id FROM `posts`
                                                INNER JOIN users 
                                                ON users.user_id = posts.user_id 
                                                AND posts.post_id = $post_id");

        $comments = $this->db->query("SELECT 
                                                users.user_name, 
                                                comments.comment_text 
                                            FROM `comments` 
                                            INNER JOIN users 
                                            ON 
                                            comments.user_id = users.user_id 
                                            AND comments.post_id = $post_id");
        $data['users_data'] = $users->result();
        $data['posts_data'] = $posts->result();
        $data['comments_data'] = $comments->result();
        echo json_encode($data);
    }
    
    public function setComment($post_id, $user_id, $text){
        $this->db->query("INSERT INTO comments 
                            VALUES ($post_id, $user_id, '$text', NULL)");
    }

    public function deletePost($post_id){
        $this->db->query("DELETE FROM likes WHERE post_id = $post_id");
        $this->db->query("DELETE FROM comments WHERE post_id = $post_id");
        $this->db->query("DELETE FROM posts WHERE post_id = $post_id");
    }
}