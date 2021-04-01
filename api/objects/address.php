<?php
class Address{

    // database connection and table name
    private $conn;
    private $table_name = "address";
  
    // object properties

    public $id;
    public $user_id;
    public $name;
    public $contact;
    public $address_line_1;
    public $address_line_2;
    public $city;
    public $postalcode;
    public $note;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // query to read single record
    $query = "SELECT
                a.id, a.user_id, a.name, a.contact, a.address_line_1, a.address_line_2, a.city, a.postalcode, a.note
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
                a.id, a.user_id, a.name, a.contact, a.address_line_1, a.address_line_2, a.city, a.postalcode, a.note
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
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->contact=htmlspecialchars(strip_tags($this->contact));
    $this->address_line_1=htmlspecialchars(strip_tags($this->address_line_1));
    $this->address_line_2=htmlspecialchars(strip_tags($this->address_line_2));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->postalcode=htmlspecialchars(strip_tags($this->postalcode));
    $this->note=htmlspecialchars(strip_tags($this->note));

    // query to insert record

       $query = "
    INSERT INTO
                " . $this->table_name . "
            SET
                user_id=:user_id, name=:name, contact=:contact, address_line_1=:address_line_1, address_line_2=:address_line_2, city=:city, postalcode=:postalcode, note=:note;";      
        
    


    // prepare query user
    $stmt = $this->conn->prepare($query);

  

    // bind values address

    $stmt->bindParam(":user_id", $this->user_id);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":contact", $this->contact);
    $stmt->bindParam(":address_line_1", $this->address_line_1);
    $stmt->bindParam(":address_line_2", $this->address_line_2);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":postalcode", $this->postalcode);
    $stmt->bindParam(":note", $this->note);

    // execute query
    if($stmt->execute()){
            return   $this->conn->lastInsertId();

    }else{
  
    return false;
        }
      
}
// update the product
function update(){

    // update query
                // var_dump($this);

    
     $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                name=:name, contact=:contact, address_line_1=:address_line_1, address_line_2=:address_line_2, city=:city, postalcode=:postalcode, note=:note WHERE`id` = :id ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);


      // sanitize user
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->contact=htmlspecialchars(strip_tags($this->contact));
    $this->address_line_1=htmlspecialchars(strip_tags($this->address_line_1));
    $this->address_line_2=htmlspecialchars(strip_tags($this->address_line_2));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->postalcode=htmlspecialchars(strip_tags($this->postalcode));
    $this->note=htmlspecialchars(strip_tags($this->note));




    // bind values user
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    $stmt->bindParam(":name", $this->name);
    $stmt->bindParam(":contact", $this->contact);
    $stmt->bindParam(":address_line_1", $this->address_line_1);
    $stmt->bindParam(":address_line_2", $this->address_line_2);
    $stmt->bindParam(":city", $this->city);
    $stmt->bindParam(":postalcode", $this->postalcode);
    $stmt->bindParam(":note", $this->note);

   // $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
    
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

    
}
?>