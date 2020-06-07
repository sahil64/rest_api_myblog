<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');
header('Access-Control-Allow-Methods: DELETE');
header('Access-Control-Allow-Headers:Access-Control-Allow-Methods,Content-Type,Access-Control-Allow-Origin,Authorization,X-Requested-With');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database =new Database();
$db=$database->connect();

//Instantiate blog post object
$post=new Post($db);

//GET raw Posted Data
$data=json_decode(file_get_contents("php://input"));

$post->id=$data->id;

//DELETE Post

if($post->delete()){
    echo json_encode(
        array('message'=>'Post DELETED')
    );
}else{
    echo json_encode(
        array('message'=>'Post Not DELETED')
    );
}
