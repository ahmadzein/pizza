<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// get database connection
include_once '../config/database.php';
  
// instantiate product object
include_once '../objects/statususer.php';
  
$database = new Database();
$db = $database->getConnection();
  
$statusUser = new StatusUser($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    
    !empty($data->user_id)&&
    !empty($data->status_id)
){
  
    // set product property values
    
    $statusUser->user_id = $data->user_id;
    $statusUser->status_id = $data->status_id;
    // create the product
    $rr =$statusUser->add();

    if($rr != false){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("result" => true ,"message" => " linked status was created.", "id" => $rr));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("result" => false ,"message" => "Unable to create  linked status."));
    }  
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("result" => false ,"message" => "Unable to add  linked status. Data is incomplete."));
}
?>