<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// include database and object files
include_once '../config/database.php';
include_once '../objects/roles.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
  
// initialize object
$roles = new Roles($db);

// query users
$stmt = $roles->get();
$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $roles_arr=array();
    $roles_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackovaerflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only

        extract($row);
  
        $roles_item=array(
            "id" => $id,
            "name" => $name,
            "description" => $description,
            "created_at" => $created_at
            
        );

        array_push($roles_arr["records"], $roles_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($roles_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no products found
    echo json_encode(
        array("message" => "No role found.")
    );
}