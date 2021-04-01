<?php
class Menu{
  
    // database connection and table name
    private $conn;
    private $table_name = "pizza";
  
    // object properties
    public $name;
    public $description;
    public $img;
    public $limit;
    public $price;
    public $created_at;

 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read menu
function get(){
  
    // select all query
    $query = "SELECT
            p.id, p.name, p.description, p.created_at, p.price, p.img
            FROM
                " . $this->table_name . "  p

            ORDER BY
                p.created_at DESC  ";
    if($this->limit > 0){
         $query .= " LIMIT " . $this->limit;
    }
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
    // create product
function add(){

      // sanitize user
    $this->f_name=htmlspecialchars(strip_tags($this->f_name));
    $this->l_name=htmlspecialchars(strip_tags($this->l_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->DOB=htmlspecialchars(strip_tags($this->DOB));
    $this->role_id=htmlspecialchars(strip_tags($this->role_id));

    /*
    $this->current_user_status_id=htmlspecialchars(strip_tags($this->current_user_status_id));
    */
    // query to insert record
    $query = "

    INSERT INTO
                 " . $this->table_name . "  
            SET
                f_name=:f_name, l_name=:l_name, email=:email, password=:password, phone=:phone, DOB=:DOB, role_id=:role_id;";
    

  
    // prepare query user
    $stmt = $this->conn->prepare($query);

  


    // bind values user
    $stmt->bindParam(":f_name", $this->f_name, PDO::PARAM_STR);
    $stmt->bindParam(":l_name", $this->l_name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindParam(":DOB", $this->DOB, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);


    // execute query
    if($stmt->execute()){
     
        
            return   $this->conn->lastInsertId();

    }else{
  
    return false;
        }
      
}
    
    
function getById(){
  $ID = $this->id;
    // query to read single record
    $query = "SELECT
            p.id, p.name, p.description, p.created_at, p.price, p.img
            
            FROM
                " . $this->table_name . "  p
               
                WHERE p.id =  ".$ID.";";
    
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  


    // execute query
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // get retrieved row

}

// update the product
function update(){

    // update query
                // var_dump($this);

    
     $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                `f_name`= :f_name, `l_name`=:l_name, `email`=:email, `password`=:password, `phone`=:phone, `DOB`=:DOB
                WHERE
                `id` = :id ";

    // prepare query statement
    $stmt = $this->conn->prepare($query);


      // sanitize user
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->f_name=htmlspecialchars(strip_tags($this->f_name));
    $this->l_name=htmlspecialchars(strip_tags($this->l_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->DOB=htmlspecialchars(strip_tags($this->DOB));
   // $this->role_id=htmlspecialchars(strip_tags($this->role_id));



    // bind values user
          $stmt->bindParam(":f_name", $this->f_name, PDO::PARAM_STR);
    $stmt->bindParam(":id", $this->id, PDO::PARAM_INT);
    $stmt->bindParam(":l_name", $this->l_name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
    $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindParam(":DOB", $this->DOB, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
   // $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
    
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

    
}
?>