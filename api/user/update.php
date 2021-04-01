<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/users.php';
  
// get database connection
$database = new Database();
$db = $database->getConnection();
  
// prepare product object
$user = new Users($db);
  
// get id of product to be edited


$data = json_decode(file_get_contents("php://input"));
// set ID property of user to be edited
    $user->id = $data->id;
// set user property values
    $user->f_name = $data->f_name;
    $user->l_name = $data->l_name;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->phone = $data->phone;
    $user->DOB = $data->DOB;
if(isset($data->role_id)){
    $user->role_id = $data->role_id;
    
}
// update the user
if($user->update()){
    // set response code - 200 ok
    http_response_code(200);
       //  session_start();
    
    if($user->id == $_SESSION['user']['id'])
{    $_SESSION["user"]["f_name"] =$user->f_name;
    $_SESSION["user"]["l_name"] =$user->l_name;}
    // tell the user
    echo json_encode(array("result" => true,"message" => "user was updated."));
}
  
// if unable to update the product, tell the user
else{
  
    // set response code - 503 service unavailable
    http_response_code(503);
  
    // tell the user
    echo json_encode(array("message" => "Unable to update user."));
}
?>