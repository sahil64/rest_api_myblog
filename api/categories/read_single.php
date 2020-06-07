<?php
header('Access-Control-Allow-Origin: *');
header('Content-type:Application/json');


include_once '../../config/Database.php';
include_once '../../models/Category.php';

//instantiate Database class and connect
$database= new Database();
$db= $database->connect();

//instantiate Category Class object
$cate= new Category($db);

// Get Category Id 
$cate->id =isset($_GET['id']) ? $_GET['id'] : die();

//Get Category from id 
$cate->read_single();

$cate_arr = array(
    'id'=>$cate->id,
    'name'=>$cate->name
);

print_r(json_encode($cate_arr));