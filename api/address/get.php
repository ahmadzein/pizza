<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/database.php';
include_once '../objects/address.php';

// get database connection
$database = new Database();
$db = $database->getConnection();

// prepare address object
$address = new Address($db);

// check ID or UID property of record to read
if(isset($_GET['id'])){  
  $address->id =  $_GET['id'];
// read the details of product to be edited
$row = $address->get();
  // get retrieved row
if($row['id'] !=null){

    // create array
    $address_arr=array(
            "id" => $row['id'],
            "user_id" => $row['user_id'],
            "name" => $row['name'],
            "contact" => $row['contact'],
            "address_line_1" => $row['address_line_1'],
            "address_line_2" => $row['address_line_2'],
            "city" => $row['city'],
            "postalcode" => $row['postalcode'],
            "note" => $row['note'],
           
            
        );
  
    // set response code - 200 OK
    http_response_code(200);
  
    // make it json format
    echo json_encode($address_arr);
}
  
else{
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user product does not exist
    echo json_encode(array("message" => "No address found."));
}
}else if(isset($_GET['uid'])){
    $address->uid = $_GET['uid'];
   // query users

$stmt = $address->getByUser();

$num = $stmt->rowCount();

// check if more than 0 record found
if($num>0){
  
    // products array
    $address_arr=array();
    $address_arr["records"]=array();
  
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
  
          $address_item=array(
            "id" => $id,
            "user_id" => $user_id,
            "name" => $name,
            "contact" => $contact,
            "address_line_1" => $address_line_1,
            "address_line_2" => $address_line_2,
            "city" => $city,
            "postalcode" => $postalcode,
            "note" =>  $note
            
            
        );
  
        array_push($address_arr["records"], $address_item);
    }
  
    // set response code - 200 OK
    http_response_code(200);
  
    // show products data in json format
    echo json_encode($address_arr);
}else{
  
    // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no address found
    echo json_encode(
        array("message" => "No address found.")
    );
} 
}else{
      // set response code - 404 Not found
    http_response_code(404);
  
    // tell the user no data provided
    echo json_encode(
        array("message" => "No data provided.")
    );
}
?>