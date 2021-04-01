<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/address.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$address =  new Address($db);
  
// get id of product to be edited


$data = json_decode(file_get_contents("php://input"));
// set ID property of user to be edited
    $address->id = $data->id;
// set user property values
    $address->name = $data->name;
    $address->contact = $data->contact;
    $address->address_line_1 = $data->address_line_1;
    $address->address_line_2 = $data->address_line_2;
    $address->city = $data->city;
    $address->postalcode = $data->postalcode;
    $address->note = $data->note;
   // $user->role_id = $data->role_id;

// update the user
if($address->update()){
  
    // set response code - 200 ok
    http_response_code(200);

    // tell the user
    echo json_encode(array("result" => true,"message" => "address was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update address."));
}
?>