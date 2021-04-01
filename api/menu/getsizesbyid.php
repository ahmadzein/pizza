<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/sizes.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$sizes = new Sizes($db);
// check ID or UID property of record to read
 
  $sizes->id =  $_GET['id'];

// read the details of product to be edited
$row = $sizes->getById();
  // get retrieved row
if($row['id'] !=null){

    // create array
    $size_arr=array(
            "id" => $sizes->id,
            "name" => $row['name'],
            "description" => $row['description'],
            "price_base" => $row['price_base']     
            
        );
  
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($size_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the size does not exist
    echo json_encode(array("message" => "No size found."));

}
?>