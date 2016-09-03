<!DOCTYPE html>
<html>
    <head>
        <title>Guest Book</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/bootstrap.min.js"></script>
        <script src="jQuery/jquery-3.1.0.min.js"></script>
        <link rel="stylesheet" type="text/css" href="custom.css">
        <script src="customJs.js"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
              <div class="col-sm-1">
              </div>
              <div class="col-sm-10">
                <form>
                  <div class="form-group">
                    <label>Name:</label>
                    <input type="text" class="form-control" id="name">
                  </div>
                  <div class="form-group">
                    <label>Comment:</label>
                    <textarea class="form-control" rows="5" id="comment"></textarea>
                  </div>
                  <button type="button" class="btn btn-primary" id="submitBtn" onclick="postComment()">Submit</button>
                </form>
                <br>
                <br>
                <?php

                    include 'db_info.php';
                    try{
                      $conn = new PDO("mysql:host=$servername;dbname=guestbook", $username,$password);
                      $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                      $status = $conn->getAttribute(PDO::ATTR_CONNECTION_STATUS);
                      if ($status) {
                        $query = $conn->query("SELECT name, comment, DATE_FORMAT(posttime,'%Y-%c-%e %H:%i') AS posttime FROM Comments");
                        $result = $query->fetchAll(PDO::FETCH_OBJ);
                        echo "<p><span class=\"badge\" id=\"numOfComments\">".count($result)."</span> Comments:</p>";
                        echo "<div class=\"row\" id=\"content\">";
                        if (count($result)){
                          foreach ($result as $key => $value) {
                            echo "
                              <div class=\"col-sm-1\"></div>
                              <div class=\"col-sm-11\">
                                <h4>".
                                  $value->name."<small> ".$value->posttime."</small></h4>
                                <p>".$value->comment."</p>
                              </div>";
                          }
                          echo "</div>";
                        }
                      }
                    }catch(PDOException $e){
                      echo "<p><span class=\"badge\">0</span> Comments:</p>";
                      echo $e->getMessage();
                    }

                 ?>
              </div>
              <div class="col-sm-1">
              </div>
            </div>
        </div>
    </body>
</html>
