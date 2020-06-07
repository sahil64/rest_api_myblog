<?php
header('Access-Origin-Allow-Origin:*');
header('Content-Type:Application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers:Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantisate Database class object and connect db
$database=new Database();
$db=$database->connect();

//instantisate Category class 
$cate= new Category($db);

//get Value from post
//echo file_get_contents("php://input");
$data=json_decode(file_get_contents("php://input"));
//print_r($data);


//Assigning value to cate vars
$cate->id= $data->id;
$cate->name= $data->name;

if ($cate->create()){
    echo json_encode(array('Messsage'=>'Category Created Successfully'));
}else{
    echo json_encode(array('Message'=>'Error while Processing Request'));
}