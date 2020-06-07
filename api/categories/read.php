<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type:Application/json');

include_once '../../config/Database.php';
include_once '../../models/Category.php' ;

// Creating Database class object which will intiate the connection
$database = new Database();
$db=$database->connect();

// crating Category Class object 
$cate = new Category($db);

// Calling read function to get all the categories from tables
$result=$cate->read();

$num=$result->rowCount();
if ($num>0){
    $cate_arr=array();
    $cate_arr['data']=array();
    print_r(json_encode($result->fetchAll(PDO::FETCH_ASSOC)));

}else{
    echo json_encode(array('message'=>'No Records Found'));
}
