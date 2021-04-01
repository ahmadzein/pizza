<?php
class Status{

    // database connection and table name
    private $conn;
    private $table_name = "status";
  
    // object properties

    public $id;
    public $name;
    public $description;

    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // select all query
    $query = "SELECT
            p.id, p.name, p.description
            FROM
                " . $this->table_name . "  p ;";
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
function getById(){

    // query to read single record
    $query = "SELECT
                p.id, p.name, p.description, 
            FROM
                " . $this->table_name . "  p
               
                WHERE p.id =  :id;";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);


    // execute query
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // get retrieved row

}
}
?>