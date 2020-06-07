<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: Application/json');

include_once '../../config/Database.php';
include_once '../../models/Post.php';

$database =new Database();
$db=$database->connect();

$posts=new Post($db);

$result=$posts->read();
$num =$result->rowCount();


if($num>0){
    $posts_arr=array();
    $posts_arr['data']=array();
    while($row=$result->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $post_item=array(
            'id'=>$id,
            'title'=>$title,
            'body'=>$body,
            'author'=>$author,
            'category_name'=>$category_name,
        );
        array_push($posts_arr['data'],$post_item);
    }
    echo json_encode($posts_arr);
}else{
    //No Posts
    echo json_encode(array('message'=>'No Posts Found'));

}