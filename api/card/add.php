<?php

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate user object
include_once '../objects/card.php';
    

$database = new Database();
$db = $database->getConnection();
  
$card = new Card($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));

// make sure data is not empty
if(
    !empty($data->user_id) &&
    !empty($data->cardname) &&
    !empty($data->cardnumber) &&
    !empty($data->expmonth)&&
    !empty($data->expyear)&&
    !empty($data->cvv)&&
    !empty($data->address_id)
){

    // set product property values
    $card->user_id = $data->user_id;
    $card->name = $data->cardname;
    $card->number = $data->cardnumber;
    $card->xmonth = $data->expmonth;
    $card->xyear = $data->expyear;
    $card->cvv = $data->cvv;
    $card->address_id = $data->address_id;
    // create the product
    $rr =$card->add();
    if($rr != false){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("result" => true ,"message" => "card was created. " , "id" => $rr));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("result" => false ,"message" => "Unable to create card."));
    }  
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("result" => false ,"message" => "Unable to create card. Data is incomplete."));
}
?>