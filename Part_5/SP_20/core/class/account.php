<?php 
namespace Core\Class;

// If constant is not defined error 403 + exit().
if (!defined('ACCESS_GRANTED')) {
    http_response_code(403);
    exit();
}

require_once (INC_PATH.'/database.php');

use Core\Email\EmailSender;

$pdo = get_PDO();

/*

class Account {
    ****SETTER OR GETTER****
        $this->get_status()     :       get status as a check to if == "OFF"
                                        return assoc array or false
        $this->set_status()     :       set status to VALIDATE
                                        return true or false
    ************************

    ****CRUD****
        $this->create()         :       create a new account with two values $email and $password
                                        return true or false

        $this->check_email()    :       check if email exist for log in matter 
                                        return assoc array

        $this->update()         :       update email and password (check template/account.php)
                                        return true or false

        $this->update()         :       delete account by id (check template/account.php)
                                        return true or false
    ************
}

*/

class Account {

    private $conn;
    private $table ="accounts";

    public $id;
    public $email;
    public $password;
    public $created_at;
    public $role = 'USER';
    public $status = 'OFF'; // Two state : OFF / VALIDATE
 
    public function __construct($pdo){
        $this->conn = $pdo;
    }

    public function get_status(){
        $sql = "SELECT status FROM ".$this->table." WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

        if($stmt->execute()){
            return $stmt->fetch(\PDO::FETCH_ASSOC);
        }
        
        return false;
    }

    public function set_status(){
        $sql = "UPDATE ".$this->table." SET 
            status = :status WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
            
        $this->status = "VALIDATE";

        $stmt->bindValue(':status', $this->status, \PDO::PARAM_STR);
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_STR);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    // CREATE
    public function create(){
        $sql = "INSERT INTO ".$this->table."(email, password, role, status) VALUES(:email, :password, :role, :status)";

        // prepared request
        $stmt = $this->conn->prepare($sql);

        // Before binding, set our password
        $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);

        // Bind values
        $stmt->bindValue(":email", $this->email, \PDO::PARAM_STR); // WHY "/PDO" ? It is a global class out of this class Account
        $stmt->bindValue(":password", $this->password, \PDO::PARAM_STR);
        // Default role = 'USER'
        $stmt->bindValue(":role", $this->role, \PDO::PARAM_STR);
        // Default status = 'OFF'
        $stmt->bindValue(":status", $this->status, \PDO::PARAM_STR);
        // To change our default status, I'm going to send an email with a link to a script.
        // Which only real email will be able to access my site.

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    public function check_email(){
        $sql = "SELECT * FROM ".$this->table." WHERE email = :email";

        $stmt = $this->conn->prepare($sql); 
        
        $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        $stmt->bindValue(':email', $this->email, \PDO::PARAM_STR);

        $stmt->execute();
        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
        
    // READ
    public function read(){
        $sql = "SELECT * FROM ".$this->table." WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        
        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function update(){
        $sql = "UPDATE ".$this->table." SET 
            email = :email";

        if(!empty($this->password)){
            $sql .= ", password = :password";
            $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        }

        $sql .= " WHERE id = :id";
        
        $stmt = $this->conn->prepare($sql);
        
        $this->email = filter_var($this->email, FILTER_VALIDATE_EMAIL);

        $stmt->bindValue(':id',$this->id, \PDO::PARAM_INT);
        $stmt->bindValue(':email',$this->email, \PDO::PARAM_STR);

        if(!empty($this->password)){
            $stmt->bindValue(':password',$this->password, \PDO::PARAM_STR);
        }

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    // DELETE
    public function delete(){
        $sql = "DELETE FROM ".$this->table." WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        } else{
            return false;
        }
    }
}

?>