<?php

    Class Post{
        private $conn;
        private $table='posts';

        //post properties
        public $id;
        public $category_id;
        public $categoty_name;
        public $body;
        public $author;
        public $title;
        public $created_at;

        public function __construct($db){
            $this->conn= $db;
        }

        //get posts
        public function read(){
            $qry='select 
                    p.id,
                    p.category_id,
                    c.name as category_name,
                    p.title,
                    p.body,
                    p.author 
                FROM 
                    '.$this->table. ' p 
                left join
                     categories c on p.category_id=c.id';
            $stmt=$this->conn->prepare($qry);
            $stmt->execute();
            return $stmt;
        }

        //Get post
        public function read_single(){
            $qry='SELECT 
                    p.id,
                    p.category_id,
                    c.name as category_name,
                    p.title,
                    p.body,
                    p.author 
                FROM 
                    '.$this->table. ' p 
                LEFT join
                     categories c on p.category_id=c.id
                WHERE 
                p.id= ?
                LIMIT 0,1';
            //Preapare Statement    
            $stmt=$this->conn->prepare($qry);
            
            //Bind ID
            $stmt->bindParam(1,$this->id);

            //Execute Query
            $stmt->execute();
            
            $row =$stmt->fetch(PDO::FETCH_ASSOC);

            //Set properties
            $this->title =$row['title'];
            $this->body =$row['body'];
            $this->author=$row['author'];
            $this->category_id =$row['category_id'];
            $this->category_name =$row['category_name'];
        }
        //Create Post
        public function create(){
            //create query
            $query='INSERT INTO '.
                $this->table . ' 
                SET
                title= :title,
                body = :body,
                author = :author,
                category_id = :category_id
                ';
            $stmt=$this->conn->prepare($query);

            //BInd data
            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':body',$this->body);
            $stmt->bindParam(':author',$this->author);
            $stmt->bindParam(':category_id',$this->category_id);
            
            if ($stmt->execute()){
                return TRUE;
            }else{
                printf("Error: %s.\n".$stmt->error);
                return FALSE;
            }
        }
        //Update Post
        public function update(){
            //create query
            $query='UPDATE '.
                    $this->table . ' 
                SET
                    title= :title,
                    body = :body,
                    author = :author,
                    category_id = :category_id
                WHERE
                    id= :id ';

            $stmt=$this->conn->prepare($query);

            //BInd data
            $stmt->bindParam(':title',$this->title);
            $stmt->bindParam(':body',$this->body);
            $stmt->bindParam(':author',$this->author);
            $stmt->bindParam(':category_id',$this->category_id);
            $stmt->bindParam(':id',$this->id);

            if ($stmt->execute()){
                return TRUE;
            }
            
            printf("Error: %s.\n".$stmt->error);
            return FALSE;
            
        }

        //DELETE POST 
        public function delete(){
            $query='DELETE FROM ' .$this->table .' where id = :id';
            
            //Prepare Statement
            $stmt=$this->conn->prepare($query);

            //BInd Data
            $stmt->bindParam(':id', $this->id);

            //Execute Query
            if ($stmt->execute()){
                return true;
            }
            //print error if it goes wrong
            printf("Error: %s.\n".$stmt->error);
            return FALSE;
        }
    } 