<?php
class Users{
  
    // database connection and table name
    private $conn;
    private $table_users = "users";
    private $table_address = "address";
  
    // object properties
    public $role;
    public $status;
    public $id;
    public $f_name;
    public $l_name;
    public $email;
    public $phone;
    public $DOB;
    public $address_name;
    public $contact;
    public $address_line_1;
    public $address_line_2;
    public $city;
    public $postalcode;
    public $note;
    
  
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
        $this->conn2 = $db;
    }
    // read products
function get(){
  
    // select all query
    $query = "SELECT
                c.name as role, s.name as status, p.id, p.f_name, p.l_name, p.email, p.phone, p.DOB,
                a.name as address_name, a.contact, a.address_line_1, a.address_line_2,a.city, a.postalcode, a.note
            FROM
                users p
                LEFT JOIN
                    role c
                    ON p.role_id = c.id
                LEFT JOIN
                address a
                ON p.primary_address_id = a.id
                LEFT JOIN
                status s
                ON p.current_user_status_id = s.id

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
    $this->id = uniqid();

      // sanitize user
    $this->f_name=htmlspecialchars(strip_tags($this->f_name));
    $this->l_name=htmlspecialchars(strip_tags($this->l_name));
    $this->email=htmlspecialchars(strip_tags($this->email));
    $this->password=htmlspecialchars(strip_tags($this->password));
    $this->phone=htmlspecialchars(strip_tags($this->phone));
    $this->DOB=htmlspecialchars(strip_tags($this->DOB));
    $this->role_id=htmlspecialchars(strip_tags($this->role_id));
    $this->current_user_status_id=htmlspecialchars(strip_tags($this->current_user_status_id));
    
    // query to insert record
    $queryUser = "
                   SET FOREIGN_KEY_CHECKS=0;

    INSERT INTO
                users
            SET
                id=:id', f_name=:f_name', l_name=:l_name', email=:email', password=:password', phone=:phone', DOB=:DOB', role_id=$this->role_id, current_user_status_id=$this->current_user_status_id;";
    
   
  
    // prepare query user
    $stmtUser = $this->conn->prepare($queryUser);

  

  
    /* bind values user
    $stmtUser->bindParam(":f_name", $this->f_name);
    $stmtUser->bindParam(":l_name", $this->l_name);
    $stmtUser->bindParam(":email", $this->email);
    $stmtUser->bindParam(":password", $this->password);
    $stmtUser->bindParam(":phone", $this->phone);
    $stmtUser->bindParam(":DOB", $this->DOB);
    $stmtUser->bindParam(":phone", $this->phone);
    $stmtUser->bindParam(":role_id", $this->role_id);
    $stmtUser->bindParam(":current_user_status_id", $this->current_user_status_id);
    */

    // execute query
    if($stmtUser->execute()){
                // sanitize address

    $this->name=htmlspecialchars(strip_tags($this->name));
    $this->contact=htmlspecialchars(strip_tags($this->contact));
    $this->address_line_1=htmlspecialchars(strip_tags($this->address_line_1));
    $this->address_line_2=htmlspecialchars(strip_tags($this->address_line_2));
    $this->city=htmlspecialchars(strip_tags($this->city));
    $this->postalcode=htmlspecialchars(strip_tags($this->postalcode));
    $this->note=htmlspecialchars(strip_tags($this->note));
            // query to insert record

       $queryAddress = "
    INSERT INTO
                address
            SET
                user_id=:id', name=:name', contact=:contact', address_line_1=:address_line_1', address_line_2=:address_line_2', city=:city', postalcode=:postalcode', note=:note';";      
        
        // prepare query address

 $stmtAddress = $this->conn2->prepare($queryAddress);

                /* bind values address

    $stmtAddress->bindParam(":user_id", $this->id);
    $stmtAddress->bindParam(":name", $this->name);
    $stmtAddress->bindParam(":contact", $this->contact);
    $stmtAddress->bindParam(":address_line_1", $this->address_line_1);
    $stmtAddress->bindParam(":address_line_2", $this->address_line_2);
    $stmtAddress->bindParam(":city", $this->city);
    $stmtAddress->bindParam(":postalcode", $this->postalcode);
    $stmtAddress->bindParam(":note", $this->note);
        */
        print_r($stmtAddress);
        if($stmtAddress->execute()){
        return true;
        }else{
                return false;

        }
    }else{
  
    return false;
        }
      
}
}
?>