<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type:Application/json');
header('Access-Control-Allow-Header:DELETE');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantisate the database class and connect
$database = new Database();
$db=$database->connect();

//instantisate the Category Class
$cate= new Category($db);

//getting Data 
$data= json_decode(file_get_contents("php://input"));

$cate->id =$data->id;

//  Deleting post

if ($cate->delete()){
    echo json_encode(
        array('Message'=>'Category Deleted Successfully')
    );
    return true;
}else{
    echo json_encode(
        array('Message'=>'Error while Deleting Category')
    );
    return false;
}
