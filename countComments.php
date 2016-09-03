<?php
    include 'db_info.php';
    try{
      $conn = new PDO("mysql:host=$servername;dbname=guestbook", $username,$password);
      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
      $query = $conn->query("SELECT * FROM Comments");
      $result = $query->fetchAll(PDO::FETCH_OBJ);
      echo count($result);
    }catch(PDOException $e){
      echo "failed";
    }
?>
