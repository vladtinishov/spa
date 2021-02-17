<?php
require_once('rest.php');
class Patients_model extends CI_Model{
    private $base;
    private $query;
    public function __construct()
    {
        $this->query = new Rest();
    }
    
    public function get($sql){
        $result = $this->query->query($sql);
        return $result;
    }

    public function post($sql){
        $result = $this->query->query($sql);
        return $result;
    }

    public function put($sql){
        $result = $this->query->query($sql);
        var_dump($result);
    }

    public function delete($sql){
        $result = $this->query->query($sql);
        return $result;
    }
}