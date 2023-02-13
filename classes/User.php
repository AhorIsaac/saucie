<?php
class User extends Connect {

    public function registerUser($fields) 
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO users($implodeColumns) VALUES(:".$implodePlaceholder.") ";

        $stmt = $this->connection()->prepare($sql);

        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }

        $stmtExec = $stmt->execute();

        if($stmtExec) {
            return TRUE;                                                                       
        }        
    }
    
    
    // check for valid user email
    public function validUserEmail($email) 
    {
        $sql = "SELECT email FROM users WHERE  `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    
    // check for valid user account
    public function validUserAccount($email, $password) 
    {
        $sql = "SELECT email FROM users WHERE  `email` = '$email' AND `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    
    // retrieve a single user details
    public function userRole($email) 
    {
        $sql = "SELECT role FROM users WHERE `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }        
    

    // update user information
    public function updateUserAccount($fields, $id)
    {
        $sql = "UPDATE users SET name=:name, email=:email WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        
        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmtExec = $stmt->execute(); 
        
        if ($stmtExec) {
            return TRUE;
        }
    }

    
    // select id for a single user
    public function getUserId($email)
    {
        $sql = "SELECT id FROM users WHERE `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    
    

    // change customer password
    public function changeUserPassword($email, $newpassword) 
    {
        $sql = "UPDATE users SET `password` = '$newpassword' WHERE email = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":email", $email);
        $stmtExec = $stmt->execute();
        
        if($stmtExec) {
            return TRUE;
        }   
    }
    
}
