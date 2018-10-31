<?php 
  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  include_once '../../config/Database.php';
  include_once '../../models/Comment.php';
  // Instantiate DB & connect
  $database = new Database();
  $db = $database->connect();
  // Instantiate blog post object
  $comment = new Comment($db);

  $result = $comment->read();
  $num =  $result->rowCount();
  if($num>0){
    $comments_arr['data'] = array();
    while($row = $result->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $comment_item = array(
        'id' => $id,
        'comment_text' => $comment_text,
        'post_id' => $post_id,
      );
      // Push to "data"
      // array_push($posts_arr, $post_item);
      array_push($comments_arr['data'], $comment_item);
    }
    // Turn to JSON & output
    echo json_encode($comments_arr);

  }else {
    echo json_encode(
      array('message' => 'No Comments Found')
    );
  }