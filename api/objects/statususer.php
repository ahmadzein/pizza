<?php
class StatusUser{

    // database connection and table name
    private $conn;
    private $table_name = "current_user_status";
  
    // object properties

    public $id;
    public $user_id;
    public $status_id;
    public $created_at;

    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // query to read single record
    $query = "SELECT
                a.id, a.user_id, a.status_id, a.created_at
            FROM
                " . $this->table_name . "  a
                WHERE a.id =  ?";
    
  
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    // bind id of product to be updated
    $stmt->bindParam(1, $this->id);

    // execute query
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // get retrieved row

}
function getByUser(){
    // select all query
     $query = "SELECT
                a.id, a.user_id, a.status_id, a.created_at
            FROM
                " . $this->table_name . "  a
                WHERE a.user_id =  ?";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
        // bind id of product to be updated
    $stmt->bindParam(1, $this->uid);
    
    // execute query
    $stmt->execute();
  
    return $stmt;


}
    // create address
function add(){

   // sanitize address
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->status_id=htmlspecialchars(strip_tags($this->status_id));
    

    // query to insert record

       $query = "
    INSERT INTO
                 " . $this->table_name . "
            SET
                user_id=:user_id, status_id=:status_id;";      
        
    


    // prepare query user
    $stmt = $this->conn->prepare($query);



    // bind values address

    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":status_id", $this->status_id);

    // execute query
    if($stmt->execute()){
    return   $this->conn->lastInsertId();

    }else{
  
    return false;
        }
      
}

}
?>