<?php

class DB
{
    protected $connection;


    public function __construct($host, $user, $password, $db_name){
        $this->connection=new mysqli($host,$user,$password,$db_name);
        $this->connection->query("SET NAMES 'utf8'");


        if(mysqli_connect_error()){
            throw new Exception ('Could not connect to DB');
        }
    }

    public function query($sql){

        if(!$this->connection){
            return false;
        }

        $resultado=$this->connection->query($sql);

        if(mysqli_error($this->connection)){
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($resultado)){
            return $resultado;
        }

        $data = array();
        while($row = mysqli_fetch_assoc($resultado)){
            $data[]=$row;
        }

        return $data;
    }

    public function query2($sql){

        if(!$this->connection){
            return false;
        }

        $resultado=$this->connection->query($sql);

        if(mysqli_error($this->connection)){
            throw new Exception(mysqli_error($this->connection));
        }

        if(is_bool($resultado)){
            return $resultado;
        }

        $data = array();
        while($row = mysqli_fetch_row($resultado)){
            $data[]=$row;
        }

        return $data;
    }


    public function escape($str){
        return mysqli_escape_string($this->connection,$str);
    }
}


?>