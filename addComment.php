<?php

  include 'db_info.php';

  $name = $_GET["name"];
  $comment = $_GET["comment"];
  $posttime = $_GET["posttime"];

  //Connect to database
  try{
    $conn = new PDO("mysql:host=$servername;dbname=guestbook",$username,$password);
    $status = $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
    if (!empty($name) && !empty($comment)) {
      $stmt = $conn->prepare("INSERT INTO Comments(name,comment,posttime) VALUES(:name, :comment, STR_TO_DATE(:posttime,'%Y-%c-%e %H:%i'))");
      $stmt->bindParam(':name',$name);
      $stmt->bindParam(':comment',$comment);
      $stmt->bindParam(':posttime',$posttime);
      $stmt->execute();
      echo "success";
    }

  }catch(PDOException $e){
    echo "failed";
  }


?>
