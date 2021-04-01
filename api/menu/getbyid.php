<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/menu.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare address object
$menu = new Menu($db);
// check ID or UID property of record to read
 
  $menu->id =  $_GET['id'];
// read the details of product to be edited
$row = $menu->getById();
  // get retrieved row
if($row['id'] !=null){
 
    // create array
    $menu_arr=array(
            "id" => $row['id'],
            "name" => $row['name'],
            "price" => $row['price'],
            "img" => $row['img'],
            "description" => $row['description'],
            "created_at" => $row['created_at']
             
            
        );
  
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($menu_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "No user found."));

}
?>