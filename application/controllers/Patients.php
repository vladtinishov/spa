<?php
class Patients extends CI_Controller{
    private $base;
    private $get = "SELECT * FROM patients";
    public function __construct()
    {
        parent::__construct();
        $this->load->model('patients_model');
    }
    public function get(){
        $result = $this->patients_model->get('SELECT * FROM patients');
        header('Content-Type: application/json');
        echo json_encode($result->fetch_all());
    }

    public function post(){
        $this->patients_model->post("INSERT INTO patients (name, lastname, birthday) 
                                    VALUES ('d', 'da', '2021-03-02')");
    }

    public function put(){
        $id = $_GET['id'];
        $this->patients_model->put("UPDATE patients SET name='hello',
                                                        lastname='fworld',
                                                        birthday='2021-03-02' 
                                                        WHERE id=$id");
    }

    public function delete(){
        $id = $_GET['id'];
        $this->patients_model->delete("DELETE FROM patients WHERE id=$id");
    }

    public function index(){
        $this->load->view('main_page/index');
    }   
}


