<?php
class StatusOrder{

    // database connection and table name
    private $conn;
    private $table_name = "current_status";
  
    // object properties

    public $id;
    public $oid;
    public $status_id;
    public $status_name;
    public $status_description;
    public $status_creation;
    public $order_id;
    public $created_at;

    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // query to read single record
    $query = "SELECT
                a.id, a.order_id, a.status_id, a.created_at
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
function getByOrder(){

    // select all query
     $query = "SELECT
                 s.name as status_name,s.description as status_description, a.id, a.order_id, a.status_id, a.created_at
            FROM
                " . $this->table_name . "  a
                LEFT JOIN
                    status s
                    ON a.status_id = s.id
                WHERE a.order_id =  :oid
                ORDER BY a.created_at ASC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
        // bind id of product to be updated
    $stmt->bindParam(":oid", $this->oid);
    
    // execute query
    $stmt->execute();

    return $stmt;


}
    // create address
function add(){

   // sanitize address
    $this->status_id=htmlspecialchars(strip_tags($this->status_id));
    $this->order_id=htmlspecialchars(strip_tags($this->order_id));
    

    // query to insert record

       $query = "
    INSERT INTO
                 " . $this->table_name . "
            SET
                order_id=:order_id, status_id=:status_id;";      
        
    


    // prepare query user
    $stmt = $this->conn->prepare($query);



    // bind values address

    $stmt->bindParam(":order_id", $this->order_id);
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