<?php
class Staff extends Connect {
    
    // admin registration function
    public function registerStaff($fields) 
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO staff_table($implodeColumns) VALUES(:".$implodePlaceholder.") ";

        $stmt = $this->connection()->prepare($sql);

        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }

        $stmtExec = $stmt->execute();

        if($stmtExec) {
            session_start();
            $_SESSION["staff_register_success"] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h6 class="alert-heading"> Staff Registration Successful! </h6>
                    <p> </p>
                </div>';
            header("location: ../views/admin-homepage.php");
            exit();                                                                       
        }
    }

    
    // check for valid admin email
    public function validStaffEmail($email) {
        $sql = "SELECT email FROM staff_table WHERE  `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // retrieve admin details on login
    public function loginStaffDetails($email, $password) 
    {
        $sql = "SELECT * FROM staff_table WHERE `email` = '$email' AND `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["staff_id"] = $row["id"];
                $_SESSION["staff_name"] = $row["name"];
                $_SESSION["staff_email"] = $row["email"];
                $_SESSION["staff_password"] = $row["password"];
                $_SESSION["staff_rel_status"] = $row["rel_status"];
                $_SESSION["staff_gender"] = $row["gender"];
                $_SESSION["staff_address"] = $row["address"];
                $_SESSION["staff_dob"] = $row["dob"];
                $_SESSION["staff_role"] = $row["role"];
                $_SESSION["staff_status"] = $row["status"];
                $_SESSION["staff_profileimage"] = $row["profileimage"];
                $_SESSION["staff_salary"] = $row["salary"];
                $_SESSION["staff_telephone"] = $row["telephone"];
                
                $_SESSION["staff_login_success"] = 
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Login Successful! </h3>
                    <p> You are now signed in! </p>
                </div>';
                header("location: ../views/staff-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
    }
    

    // retrieve a single staff details
    public function selectOneStaffInfo($id) 
    {
        $sql = "SELECT * FROM staff_table WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    

    
    // update admin information by admin
    public function updateStaffInfo($fields, $id) 
    {
        $sql = "UPDATE staff_table SET name=:name, email=:email, rel_status=:rel_status, status=:status, dob=:dob, address=:address, telephone=:telephone, gender=:gender, profileimage=:profileimage WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        
        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmtExec = $stmt->execute(); 
        
        if ($stmtExec) {
            return TRUE;
        }
    }
    
    
    public function getUpdatedDetails($email) 
    {
        $sql = "SELECT * FROM staff_table WHERE `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["staff_id"] = $row["id"];
                $_SESSION["staff_name"] = $row["name"];
                $_SESSION["staff_email"] = $row["email"];
                $_SESSION["staff_rel_status"] = $row["rel_status"];
                $_SESSION["staff_gender"] = $row["gender"];
                $_SESSION["staff_address"] = $row["address"];
                $_SESSION["staff_dob"] = $row["dob"];
                $_SESSION["staff_role"] = $row["role"];
                $_SESSION["staff_status"] = $row["status"];
                $_SESSION["staff_profileimage"] = $row["profileimage"];
                $_SESSION["staff_salary"] = $row["salary"];
                $_SESSION["staff_telephone"] = $row["telephone"];
                
                $_SESSION["staff_account_update_success"] = 
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading font-weight-bold"> Information Successfully Updated! </h5>
                </div>';
                header("location: staff-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
        
    }
    
    
    // check if admin old password is valid
    public function checkOldValidStaffPassword($password) 
    {
        $sql = "SELECT password FROM staff_table WHERE `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            return TRUE;
        } else {
            return FALSE;
        }
    }


    // change admin password
    public function changeStaffPassword($newpassword, $id) 
    {
        $sql = "UPDATE staff_table SET `password` = '$newpassword' WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmtExec = $stmt->execute();
        
        if($stmtExec) {
            return TRUE;
        }   
    }
    
    
    // select all staff 
    public function selectAllStaff() 
    {
        $sql = "SELECT * FROM staff_table";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return "invalid";
        }
    }


    public function selectAllStaffIDs() 
    {
        $sql = "SELECT id FROM staff_table";
        
        $result = $this->connection()->prepare($sql);
        $result->execute();
        
        if($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        }else{
            return "invalid";
        }        
    }
    
}
