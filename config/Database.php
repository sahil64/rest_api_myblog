<?php
Class Database{
    //DB Parameters
    private $host="localhost";
    private $dbname="myblog";
    private $dbuser="root";
    private $dbpass="";
    private $conn;

    public function connect(){
        $this->conn=null;
        try{
            $this->conn=new PDO('mysql:host=' .$this->host .';dbname='.$this->dbname ,$this->dbuser,$this->dbpass);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){
            echo 'connection Error: '.$e->getMessage();
        }
        return $this->conn;
    }
}