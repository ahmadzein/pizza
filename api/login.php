<?php
session_start();
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
// get database connection
include_once './config/database.php';


$database = new Database();
$db = $database->getConnection();
        // database connection and table name
     $table_name = "users";
    $conn = $db;
// get posted data
$json = json_decode(file_get_contents("php://input"),true);
// Now we check if the data from the login form was submitted, isset() will check if the data exists.
  if ( $json['email'] == "" || $json['password'] == ""  ) {
	// Could not get the data that should have been sent.
	exit('Please fill both the username and password fields!');
}


    // query to read 
    $query = "SELECT id, password, f_name,l_name, role_id FROM ".$table_name." WHERE email = :email";
    
    // prepare query statement
    $stmt = $conn->prepare( $query );


if ($stmt) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bindParam(":email", $json['email']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
    $row  = $stmt->fetch(PDO::FETCH_ASSOC);
      if ($row) {
	$id = $row["id"];
    $password = $row["password"];
	// Account exists, now we verify the password.
	// Note: remember to use password_hash in your registration file to store the hashed passwords.
	if ($json['password'] == $password) {
		// Verification success! User has logged-in!
		// Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server.
		session_regenerate_id();
		$_SESSION['loggedin'] = TRUE;
		$_SESSION['user']['email'] = $json['email'];
		$_SESSION['user']['id'] = $id;
        
    $_SESSION["user"]["f_name"] =$row["f_name"];
    $_SESSION["user"]["l_name"] =$row["l_name"];
    $_SESSION["user"]["role"] =$row["role_id"];
    //$_SESSION["user"]["postalcode"] =$JData["postalcode"];
   // $_SESSION["user"]["status_id"] =$user_status;
        
		echo true;
	} else {
		// Incorrect password
		echo 'Incorrect username and/or password!';
	}
} else {
	// Incorrect username
	echo 'Incorrect username and/or password!';
}

}
?>