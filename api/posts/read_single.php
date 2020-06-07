<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

//Instantiate DB & connect
$database =new Database();
$db=$database->connect();

//Instantiate blog post object
$post=new Post($db);

//echo $_GET['id'];
//GEt ID
$post->id=isset($_GET['id']) ? $_GET['id'] : die();

//Get post
$post->read_single();

$post_arr=array(
    'id'=> $post->id,
    'title'=>$post->title,
    'body'=>$post->body,
    'author'=>$post->author,
    'category_id'=>$post->category_id,
    'category_name'=>$post->category_name
);
print_r(json_encode($post_arr));

?>
