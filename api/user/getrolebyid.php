<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/roles.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare address object
$roles = new Roles($db);
// check ID or UID property of record to read
 
  $roles->id =  $_GET['id'];

// read the details of product to be edited
$row = $roles->getById();
  // get retrieved row
if($row['id'] !=null){

    // create array
    $role_arr= array(
            "id" => $roles->id,
            "name" => $row['name'],
            "description" => $row['description'],
            "created_at" => $row['created_at']      
            
        );
  
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($role_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the role product does not exist
    echo json_encode(array("message" => "No role found."));

}
?>