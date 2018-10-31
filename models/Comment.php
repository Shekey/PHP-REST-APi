<?php 

class Comment {
 private $conn;
 private $table = "comments";

 public $id;
 public $comment_text;
 public $post_id;

 public function __construct($db){
   $this->conn = $db;
 }
 public function read(){
   $query = "SELECT id,comment_text,post_id  FROM ".$this->table;
   $stmt = $this->conn->prepare($query);
   $stmt->execute();
   return $stmt; 
 }
 public function create(){
  $query = 'INSERT INTO ' . $this->table . ' SET comment_text = :comment, post_id = :post';
  // Prepare statement
  $stmt = $this->conn->prepare($query);
  $this->comment_text = htmlspecialchars(strip_tags($this->comment_text));

  $stmt->bindParam(':comment', $this->comment_text);
  $stmt->bindParam(':post', $this->post_id);

  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);
  return false;
 }
 public function update(){
  $query = 'UPDATE ' . $this->table . ' SET comment_text = :comment, post_id = :post WHERE id = :id';
  // Prepare statement
  $stmt = $this->conn->prepare($query);
  $this->comment_text = htmlspecialchars(strip_tags($this->comment_text));

  $stmt->bindParam(':comment', $this->comment_text);
  $stmt->bindParam(':post', $this->post_id);
  $stmt->bindParam(':id', $this->id);

  if($stmt->execute()) {
    return true;
  }
  // Print error if something goes wrong
  printf("Error: %s.\n", $stmt->error);
  return false;
 }
 public function delete(){
  $query = 'DELETE FROM '.$this->table. ' WHERE id = :id';
  $stmt =  $this->conn->prepare($query);
  $this->id = htmlspecialchars(strip_tags($this->id));
  $stmt->bindParam(':id', $this->id);
    if($stmt->execute()) {
      return true;
    }
  }
} 