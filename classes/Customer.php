<?php

class Customer extends Connect {
    
    // customer registration function
    public function registerCustomer($fields) 
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO customer_table($implodeColumns) VALUES(:".$implodePlaceholder.") ";

        $stmt = $this->connection()->prepare($sql);

        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }

        $stmtExec = $stmt->execute();

        if($stmtExec) {
            session_start();
            $_SESSION["customer_register_success"] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; font-size: 13px; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h6 class="alert-heading"> Customer Registration <br /> Successful! </h6>
                    <p> You can now signed in! </p>
                </div>';
            header("location: ../views/users-login.php");
            exit();                                                                       
        }
    }    
    
    // check for valid customer email
    public function validCustomerEmail($email) 
    {
        $sql = "SELECT email FROM customer_table WHERE  `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    
    // retrieve customer details on login
    public function loginCustomerDetails($email, $password) 
    {
        $sql = "SELECT * FROM customer_table WHERE `email` = '$email' AND `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["cus_id"] = $row["id"];
                $_SESSION["cus_name"] = $row["name"];
                $_SESSION["cus_email"] = $row["email"];
                $_SESSION["cus_rel_status"] = $row["rel_status"];
                $_SESSION["cus_gender"] = $row["gender"];
                $_SESSION["cus_address"] = $row["address"];
                $_SESSION["cus_dob"] = $row["dob"];
                $_SESSION["cus_role"] = $row["role"];
                $_SESSION["cus_status"] = $row["status"];
                $_SESSION["cus_profileimage"] = $row["profileimage"];
                $_SESSION["cus_salary"] = $row["salary"];
                $_SESSION["cus_telephone"] = $row["telephone"];
                
                $_SESSION["customer_login_success"] = 
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Login Successful! </h3>
                    <p> You are now signed in! </p>
                </div>';
                header("location: ../views/customers-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
    }
    
    public function getUpdatedDetails($email) 
    {
        $sql = "SELECT * FROM customer_table WHERE `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["cus_id"] = $row["id"];
                $_SESSION["cus_name"] = $row["name"];
                $_SESSION["cus_email"] = $row["email"];
                $_SESSION["cus_rel_status"] = $row["rel_status"];
                $_SESSION["cus_gender"] = $row["gender"];
                $_SESSION["cus_address"] = $row["address"];
                $_SESSION["cus_dob"] = $row["dob"];
                $_SESSION["cus_role"] = $row["role"];
                $_SESSION["cus_status"] = $row["status"];
                $_SESSION["cus_profileimage"] = $row["profileimage"];
                $_SESSION["cus_salary"] = $row["salary"];
                $_SESSION["cus_telephone"] = $row["telephone"];
                
                $_SESSION["update_success"] = 
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading font-weight-bold"> Information Successfully Updated! </h5>
                </div>';
                header("location: ../views/customers-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
        
    }
    
    // retrieve a single customer details
    public function selectOneCustomerInfo($id) 
    {
        $sql = "SELECT * FROM customer_table WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }    
    
    
    // update customer information
    public function updateCustomerInfo($fields, $id) 
    {
        $sql = "UPDATE customer_table SET name=:name, email=:email, rel_status=:rel_status, status=:status, dob=:dob, address=:address, telephone=:telephone, gender=:gender, profileimage=:profileimage WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        
        foreach($fields as $key => $value) {
            $stmt->bindValue(":".$key, $value);
        }
        $stmtExec = $stmt->execute(); 
        
        if ($stmtExec) {
            return TRUE;
        }
    }

    
    // check if customer's old password is valid
    public function checkOldValidCustomerPassword($password) 
    {
        $sql = "SELECT password FROM customer_table WHERE `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {   
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // change customer password
    public function changeCustomerPassword($newpassword, $id) 
    {
        $sql = "UPDATE customer_table SET `password` = '$newpassword' WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmtExec = $stmt->execute();
        
        if($stmtExec) {
            return TRUE;
        }   
    }
        
    public function checkActiveUserStatus($id) 
    {
        $sql = "SELECT status FROM customer_table WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // select all customers 
    public function selectAllCustomers() 
    {
        $sql = "SELECT * FROM customer_table";
        
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
