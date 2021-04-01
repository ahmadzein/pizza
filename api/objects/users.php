<?php
class Users{
  
    // database connection and table name
    private $conn;
    private $table_name = "users";
  
    // object properties
    public $role;
    public $role_id;
    public $status;
    public $id;
    public $f_name;
    public $l_name;
    public $email;
    public $phone;
    public $DOB;
    public $search;
 
  
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
    
    function search(){
        $this->search=htmlspecialchars(strip_tags($this->search));

    // select all query
    $query = "SELECT
                id, email, f_name, l_name
            FROM
                " . $this->table_name . "  
                
                WHERE f_name  LIKE :search  OR l_name  LIKE :search  OR email LIKE :search    
            ORDER BY
                email DESC";
  
    // prepare query statement
    $stmt = $this->conn->prepare($query);
  $term = '%' . $this->search . '%';
        $stmt->bindParam(":search", $term , PDO::PARAM_STR);
    // execute query
    $stmt->execute();
  
    return $stmt;
}
    // create product
function add(){
    $this->email=htmlspecialchars(strip_tags($this->email));

     
    /*
    $this->current_user_status_id=htmlspecialchars(strip_tags($this->current_user_status_id));
    */
    
    $query = " SELECT
                email
            FROM
                " . $this->table_name . "  
                
                WHERE email = :email";
     $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":email", $this->email, PDO::PARAM_STR);
    $stmt->execute();
 if($stmt->rowCount()>0){

//print_r($stmt->fetch(PDO::FETCH_ASSOC));
            return   "exst";

    }else{
     
     
    
         // sanitize user
    $this->id=htmlspecialchars(strip_tags(uniqid("pzu")));
    $this->f_name=htmlspecialchars(strip_tags($this->f_name));
    $this->l_name=htmlspecialchars(strip_tags($this->l_name));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->DOB=htmlspecialchars(strip_tags($this->DOB));
    $this->role_id=htmlspecialchars(strip_tags($this->role_id));

    // query to insert record
    $query = "

    INSERT INTO
                 " . $this->table_name . "  
            SET
                id=:id, f_name=:f_name, l_name=:l_name, email=:email, password=:password, phone=:phone, DOB=:DOB, role_id=:role_id;";
    

  
    // prepare query user
    $stmt = $this->conn->prepare($query);

  


    // bind values user
    $stmt->bindParam(":id", $this->id, PDO::PARAM_STR);
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
     

            return   $this->id;

    }else{
  
    return false;
        }
    
   
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