<?php
  /*Sample JSON format
  { "order_id":1, "product_id":1, "user_id":1, "rating":1, "review":"review" }
  */
  //Connect to DB
  $hostname = "localhost";
  $user_db = "root";
  $pass_db = "";
  $dbname = "kulina";
  try {
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname",$user_db,$pass_db);
  } catch (Exception $e) {
    echo $e->getMessage();
  }
  //
  $content = file_get_contents("php://input");
  $decoded = json_decode($content, true);
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $query="SELECT * FROM user_review";
    $statement=$conn->query($query);
    $statement->setFetchMode(PDO::FETCH_ASSOC);
  	$rows = array();
  	while ($row = $statement->fetch()){
  		$rows[] = $row;
  	}
  	$myJSON = json_encode($rows);
  	header('Content-type: application/json');
  	echo $myJSON;
  }
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  	$ORDER_ID = $decoded['order_id'];
  	$PRODUCT_ID = $decoded['product_id'];
  	$USER_ID = $decoded['user_id'];
  	$RATING = $decoded['rating'];
  	$REVIEW = $decoded['review'];
    $query= "INSERT INTO user_review (order_id, product_id, user_id, rating, review) VALUES ('$ORDER_ID', '$PRODUCT_ID', '$USER_ID', '$RATING', '$REVIEW')";
    $statement=$conn->prepare($query);
    $statement->execute();
  }
  if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
  	$ID = $decoded['id'];
  	$RATING = $decoded['rating'];
  	$REVIEW = $decoded['review'];
  	$query = "UPDATE user_review SET rating='$RATING', review='$REVIEW' WHERE id='$ID'";
    $statement=$conn->prepare($query);
    $statement->execute();
  }
  if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
  	$ID = $decoded['id'];
  	$query = "DELETE FROM user_review WHERE id='$ID'";
    $statement=$conn->prepare($query);
    $statement->execute();
  }
?>
