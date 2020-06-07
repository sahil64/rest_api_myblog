<?php

class Category{
    private $conn;
    private $table='categories';

    //category properties
    public $id;
    public $name;

    public function __construct($db){
        $this->conn = $db;
    }
    
    // Read all the categories
    public function read(){
        $qry='SELECT id, name FROM ' . $this->table . ' ORDER BY created_at DESC';
        
        //Preapre Statement         
        $stmt=$this->conn->prepare($qry);

        //execute statement 
        $stmt->execute();
        return $stmt; 
    }
    
    //Read single category
    public function read_single(){
        $qry ='SELECT id, name FROM ' . $this->table . ' where id = :id LIMIT 0,1';

        //Prepare Statement 
        $stmt=$this->conn->prepare($qry);
        
        //bind parameters
        $stmt->bindParam(':id',$this->id);

        //execute statement
        $stmt->execute();

        $row =$stmt->fetch(PDO::FETCH_ASSOC);

        //Set property
        $this->name =$row['name'];
        return $stmt;
    }

    //Create Category
    public function create(){
        $qry='INSERT into '. $this->table . ' SET name = :name ';
        
        //prepare Statement
        $stmt=$this->conn->prepare($qry);

        //Bind parameters
        $stmt->bindParam(':name',$this->name);

        //execute query
        if ($stmt->execute()){
            return true;
        }
        printf("Error %s \n" . $stmt->error);
        return false;
    }
    
    public function update(){
        $qry='UPDATE '. $this->table . ' SET name = :name where id = :id';
        
        //prepare Statement
        $stmt=$this->conn->prepare($qry);

        //Bind parameters
        $stmt->bindParam(':name',$this->name);
        $stmt->bindParam(':id',$this->id);
        //execute query
        if ($stmt->execute()){
            return true;
        }
        printf("Error %s \n" . $stmt->error);
        return false;
    }

    public function delete(){
        $qry='DELETE FROM '. $this->table . ' where id = :id';
        
        //prepare Statement
        $stmt=$this->conn->prepare($qry);

        //Bind parameters
        $stmt->bindParam(':id',$this->id);
        //execute query
        if ($stmt->execute()){
            return true;
        }
        printf("Error %s \n" . $stmt->error);
        return false;
    }
}