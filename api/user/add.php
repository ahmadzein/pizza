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
include_once '../objects/users.php';
    

$database = new Database();
$db = $database->getConnection();
  
$user = new Users($db);
  
// get posted data
$data = json_decode(file_get_contents("php://input"));
// make sure data is not empty
if(
    !empty($data->f_name) &&
    !empty($data->l_name) &&
    !empty($data->email) &&
    !empty($data->password)&&
    !empty($data->phone)&&
    !empty($data->DOB)&&
    !empty($data->role_id)
){

    // set product property values
    $user->f_name = $data->f_name;
    $user->l_name = $data->l_name;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->phone = $data->phone;
    $user->DOB = $data->DOB;
    $user->role_id = $data->role_id;
    // create the product

    $rr =$user->add();
    if($rr !== false){
        if($rr == "exst"){
            http_response_code(201);
  
        // tell the user
        echo json_encode(array("result" => false ,"message" => "User already exists. "));
        }else{
  
        // set response code - 201 created
        http_response_code(201);
  
        // tell the user
        echo json_encode(array("result" => true ,"message" => "User was created. " , "id" => $rr));
        }
    }
  
    // if unable to create the product, tell the user
    else{
  
        // set response code - 503 service unavailable
        http_response_code(503);
  
        // tell the user
        echo json_encode(array("result" => false ,"message" => "Unable to create user."));
    }  
}
  
// tell the user data is incomplete
else{
  
    // set response code - 400 bad request
    http_response_code(400);
  
    // tell the user
    echo json_encode(array("result" => false ,"message" => "Unable to create user. Data is incomplete."));
}
?>