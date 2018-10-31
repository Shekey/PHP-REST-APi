<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods,Authorization, X-Requested-With');

  include_once '../../config/Database.php';
  include_once '../../models/Comment.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $comment = new Comment($db);
  $data = json_decode(file_get_contents("php://input"));
  $comment->comment_text = $data->comment_text;
  $comment->post_id = $data->post_id;

  if($comment->create()){
    echo json_encode(array(
      'message' => 'Commend added'
    ));
  }
  else {
    echo json_encode(array(
      'message' => 'Comment is not added'
    ));
  }
