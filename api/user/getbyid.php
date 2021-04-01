<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare address object
$users = new Users($db);
// check ID or UID property of record to read
 
  $users->id =  $_GET['id'];

// read the details of product to be edited
$row = $users->getById();
  // get retrieved row
if($row['id'] !=null){

    // create array
    $user_arr= array(
            "id" => $users->id,
            "f_name" => $row['f_name'],
            "l_name" => $row['l_name'],
            "email" => $row['email'],
            "phone" => $row['phone'],
            "DOB" => $row['DOB'],
            "role" => array(
                        "id"=>$row['role_id'],
                        "name" => $row['role']
                           )         
            
        );
  
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($user_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "No user found."));

}
?>