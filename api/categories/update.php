<?php
header('Access-Control-Access-Origin:*');
header('Content-Type:Application/json');
header('Access-Control-Allow-Header:PUT');

include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate the database object and connect
$database = new Database();
$db=$database->connect();

//instantiate the Category Object 
$cate=new Category($db);

//Get data
//echo file_get_contents("php://input");
$data=json_decode(file_get_contents("php://input"));

//set Data to cate properties
$cate->id =$data->id;
$cate->name=$data->name;

if($cate->update()){
    echo json_encode(
        array('Message'=>'Category Updated Successfully')
    );
    return true;
}
echo json_encode(
    array('Message'=>'Got error while updating Category')
);