<?php
class Rest{
    public function __construct()
    {
        $this->base = new mysqli('localhost', 'root', 'root', 'codeigniter');
    }
    public function query($sql){
        if ($this->base->connect_errno) {
            printf("Не удалось подключиться: %s\n", $this->base->connect_error);
            exit();
        }
        else{
            $result = $this->base->query($sql);
            return $result;
        }
    }
}