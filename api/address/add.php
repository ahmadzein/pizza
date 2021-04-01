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
include_once '../objects/address.php';
  
$database = new Database();
$db = $database->getConnection();
  
$address = new Address($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    
    !empty($data->user_id)&&
    !empty($data->name)&&
    !empty($data->contact)&&
    !empty($data->address_line_1)&&
 //   !empty($data->address_line_2)&&
    !empty($data->city)&&
    !empty($data->postalcode)//&&
  //  !empty($data->note)
){
  
    // set product property values
    
    $address->user_id = $data->user_id;
    $address->name = $data->name;
    $address->contact = $data->contact;
    $address->address_line_1 = $data->address_line_1;
    $address->address_line_2 = $data->address_line_2;
    $address->city = $data->city;
    $address->postalcode = $data->postalcode;
    $address->note = $data->note;

    // create the product
        $rr =$address->add();

    if($rr != false){
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("result" => true ,"message" => "Address was created.", "id" => $rr));
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("result" => false ,"message" => "Unable to create address."));
    }  
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("result" => false ,"message" => "Unable to add address. Data is incomplete."));
}
?>