<?php
class Card{
  
    // database connection and table name
    private $conn;
    private $table_name = "payment_cards";
  
    // object properties
    public $user_id;
    public $name;
    public $number;
    public $xmonth;
    public $xyear;
    public $cvv;
    public $address_id;
    
 
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }
    // read products
function get(){
  
    // select all query
    $query = "SELECT
                c.name as role, p.role_id, p.id, p.f_name, p.l_name, p.email, p.phone, p.DOB
            FROM
                " . $this->table_name . "  p
                LEFT JOIN
                    role c
                    ON p.role_id = c.id
                

            ORDER BY
                p.created_at DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  
    // execute query
    $stmt->execute();
  
    return $stmt;
}
    
  
    // create product
function add(){
      // sanitize user
    $this->user_id=htmlspecialchars(strip_tags($this->user_id));
    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->number=htmlspecialchars(strip_tags($this->number));
    $this->xmonth=htmlspecialchars(strip_tags($this->xmonth));
    $this->xyear=htmlspecialchars(strip_tags($this->xyear));
    $this->cvv=htmlspecialchars(strip_tags($this->cvv));
    $this->address_id=htmlspecialchars(strip_tags($this->address_id));

    /*
    $this->current_user_status_id=htmlspecialchars(strip_tags($this->current_user_status_id));
    */
    // query to insert record
    $query = "

    INSERT INTO
                 " . $this->table_name . "  
            SET
                 user_id=:user_id, name=:name, number=:number, xmonth=:xmonth, xyear=:xyear,
                 cvv=:cvv, address_id=:address_id;";
    


    // prepare query user
    $stmt = $this->conn->prepare($query);




    // bind values user
    $stmt->bindParam(":user_id", $this->user_id, PDO::PARAM_STR);
    $stmt->bindParam(":name", $this->name, PDO::PARAM_STR);
    $stmt->bindParam(":number", $this->number, PDO::PARAM_INT);
    $stmt->bindParam(":xmonth", $this->xmonth, PDO::PARAM_INT);
    $stmt->bindParam(":xyear", $this->xyear, PDO::PARAM_INT);
    $stmt->bindParam(":xmonth", $this->xmonth, PDO::PARAM_INT);
    $stmt->bindParam(":cvv", $this->cvv, PDO::PARAM_INT);
    $stmt->bindParam(":address_id", $this->address_id, PDO::PARAM_INT);


    // execute query
    if($stmt->execute()){
     
        
            return   $this->conn->lastInsertId();

    }else{
  
    return false;
        }
      
}
    
    
function getById(){

    // query to read single record
    $query = "SELECT
                c.name as role, p.role_id, p.id, p.f_name, p.l_name, p.email, p.phone, p.DOB
            FROM
                " . $this->table_name . "  p
                LEFT JOIN
                    role c
                    ON p.role_id = c.id
                WHERE p.id =  :id;";

    // prepare query statement
    $stmt = $this->conn->prepare( $query );
  
    $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);


    // execute query
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
    // get retrieved row

}

// update the product
function update(){

    // update query
                // var_dump($this);
session_start();
    $pl =strlen($this->password);
    $currentRole=$_SESSION['user']['role'];
    if($currentRole == 1 && isset($this->role_id))
    {
        
        if($pl < 1){
           $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                `f_name`= :f_name,`role_id`= :role_id, `l_name`=:l_name, `email`=:email, `phone`=:phone, `DOB`=:DOB
                WHERE
                `id` = :id ";
    }else{
    
     $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                `f_name`= :f_name, `role_id`= :role_id, `l_name`=:l_name, `email`=:email, `password`=:password, `phone`=:phone, `DOB`=:DOB
                WHERE
                `id` = :id ";
        
    }
    
    }else{
    if($pl < 1){
         $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                `f_name`= :f_name, `l_name`=:l_name, `email`=:email, `phone`=:phone, `DOB`=:DOB
                WHERE
                `id` = :id ";
    }else{
    
     $query = "

    UPDATE 
                 " . $this->table_name . "  
            SET
                `f_name`= :f_name, `l_name`=:l_name, `email`=:email, `password`=:password, `phone`=:phone, `DOB`=:DOB
                WHERE
                `id` = :id ";
}
        }
    // prepare query statement
    $stmt = $this->conn->prepare($query);


      // sanitize user
    $this->id=htmlspecialchars(strip_tags($this->id));
    $this->f_name=htmlspecialchars(strip_tags($this->f_name));
    $this->l_name=htmlspecialchars(strip_tags($this->l_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
     if($pl > 1){
    $this->password=htmlspecialchars(strip_tags($this->password));
     }
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->DOB=htmlspecialchars(strip_tags($this->DOB));
    if($currentRole == 1 && isset($this->role_id))
    {
   $this->role_id=htmlspecialchars(strip_tags($this->role_id));

    }

    // bind values user
          $stmt->bindParam(":f_name", $this->f_name, PDO::PARAM_STR);
    $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);
    $stmt->bindParam(":l_name", $this->l_name, PDO::PARAM_STR);
    $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
         if($pl > 1){

    $stmt->bindParam(":password", $this->password, PDO::PARAM_STR);
         }    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
    $stmt->bindParam(":DOB", $this->DOB, PDO::PARAM_STR);
    $stmt->bindParam(":phone", $this->phone, PDO::PARAM_STR);
    if($currentRole == 1 && isset($this->role_id))
    {
   $stmt->bindParam(":role_id", $this->role_id, PDO::PARAM_INT);
    }
    
    // execute the query
    if($stmt->execute()){
        return true;
    }
  
    return false;
}

    
}
?>