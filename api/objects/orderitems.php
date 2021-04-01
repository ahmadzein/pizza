<?php
class OrderItems{

    // database connection and table name
    private $conn;
    private $table_name = "`order_item`";
  
    // object properties

    public $id;
    public $order_id;
    public $pizza_id;
    public $size_id;
    public $quantity;

    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // query to read single record
    $query = "SELECT
                a.id, a.user_id,  a.created_at
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
                a.id, a.order_id, a.pizza_id, a.size_id, a.quantity, p.name as pizza_name, p.price as pizza_price, p.img as pizza_img, p.description as pizza_description, s.name as size_name, s.price_base, s.description as size_description 
            FROM
                " . $this->table_name . "  a
                 LEFT JOIN
                    `order` o
                    ON a.order_id = o.id
                    LEFT JOIN
                    `pizza` p
                    ON a.pizza_id = p.id
                     LEFT JOIN
                    `size` s
                    ON a.size_id = s.id
                WHERE a.order_id =  ?";

    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
        // bind id of product to be updated
    $stmt->bindParam(1, $this->order_id);
    
    // execute query
    $stmt->execute();
  
    return $stmt;


}
    // create address
function add(){
   // sanitize address
    $this->order_id=htmlspecialchars(strip_tags($this->order_id));
    $this->pizza_id=htmlspecialchars(strip_tags($this->pizza_id));
    $this->size_id=htmlspecialchars(strip_tags($this->size_id));
    $this->quantity=htmlspecialchars(strip_tags($this->quantity));
    
    // query to insert record

       $query = " INSERT INTO " . $this->table_name . " SET `order_id` =:order_id, `pizza_id` =:pizza_id , `size_id` =:size_id ,`quantity` =:quantity";      
        
    


    // prepare query user
    $stmt = $this->conn->prepare($query);



    // bind values address

    $stmt->bindParam(":pizza_id", $this->pizza_id);
    $stmt->bindParam(":order_id", $this->order_id);
    $stmt->bindParam(":size_id", $this->size_id);
    $stmt->bindParam(":quantity", $this->quantity);
print_r($stmt);

    // execute query
    if($stmt->execute()){
    return   $this->conn->lastInsertId();

    }else{
  
    return false;
        }
      
}

}
?>