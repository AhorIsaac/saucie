<?php
class Admin extends Connect
{

    // admin registration function
    public function registerAdmin($fields)
    {
        $implodeColumns = implode(", ", array_keys($fields));

        $implodePlaceholder = implode(", :", array_keys($fields));

        $sql = "INSERT INTO admin_table($implodeColumns) VALUES(:" . $implodePlaceholder . ") ";

        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }

        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            session_start();
            $_SESSION["admin_register_success"] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h6 class="alert-heading"> Admin Registration Successful! </h6>
                    <p> </p>
                </div>';
            header("location: ../views/admin-homepage.php");
            exit();
        }
    }


    // check for valid admin email
    public function validAdminEmail($email)
    {
        $sql = "SELECT email FROM admin_table WHERE  `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // retrieve admin details on login
    public function loginAdminDetails($email, $password)
    {
        $sql = "SELECT * FROM admin_table WHERE `email` = '$email' AND `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["admin_id"] = $row["id"];
                $_SESSION["admin_name"] = $row["name"];
                $_SESSION["admin_email"] = $row["email"];
                $_SESSION["admin_password"] = $row["password"];
                $_SESSION["admin_telephone"] = $row["telephone"];
                $_SESSION["admin_rel_status"] = $row["rel_status"];
                $_SESSION["admin_gender"] = $row["gender"];
                $_SESSION["admin_address"] = $row["address"];
                $_SESSION["admin_dob"] = $row["dob"];
                $_SESSION["admin_salary"] = $row["salary"];
                $_SESSION["admin_role"] = $row["role"];
                $_SESSION["admin_status"] = $row["status"];
                $_SESSION["admin_profileimage"] = $row["profileimage"];

                $_SESSION["admin_login_success"] =
                    '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Login Successful! </h3>
                    <p> You are now signed in! </p>
                </div>';
                header("location: ../views/admin-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
    }

    // retrieve a single admin details
    public function selectOneAdminInfo($id)
    {
        $sql = "SELECT * FROM admin_table WHERE id = $id";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }



    // update admin information by admin
    public function updateAdminInfo($fields, $id)
    {
        $sql = "UPDATE admin_table SET name=:name, email=:email, telephone=:telephone, rel_status=:rel_status, gender=:gender, address=:address, dob=:dob, status=:status, role=:role, profileimage=:profileimage WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":" . $key, $value);
        }
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }


    // check if admin old password is valid
    public function checkOldAdminValidPassword($password)
    {
        $sql = "SELECT password FROM admin_table WHERE `password` = '$password' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    // change admin password
    public function changeAdminPassword($newpassword, $id)
    {
        $sql = "UPDATE admin_table SET `password` = '$newpassword' WHERE id = '$id' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->bindValue(":id", $id);
        $stmtExec = $stmt->execute();

        if ($stmtExec) {
            return TRUE;
        }
    }

    // select all drinks meals 
    public function selectAllAdmins()
    {
        $sql = "SELECT * FROM admin_table";

        $result = $this->connection()->prepare($sql);
        $result->execute();

        if ($result->rowCount() > 0) {
            while ($row = $result->fetch()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return "invalid";
        }
    }


    public function getUpdatedDetails($email)
    {
        $sql = "SELECT * FROM admin_table WHERE `email` = '$email' ";
        $stmt = $this->connection()->prepare($sql);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                session_start();
                $_SESSION["admin_id"] = $row["id"];
                $_SESSION["admin_name"] = $row["name"];
                $_SESSION["admin_email"] = $row["email"];
                $_SESSION["admin_rel_status"] = $row["rel_status"];
                $_SESSION["admin_gender"] = $row["gender"];
                $_SESSION["admin_address"] = $row["address"];
                $_SESSION["admin_dob"] = $row["dob"];
                $_SESSION["admin_role"] = $row["role"];
                $_SESSION["admin_status"] = $row["status"];
                $_SESSION["admin_profileimage"] = $row["profileimage"];
                $_SESSION["admin_salary"] = $row["salary"];
                $_SESSION["admin_telephone"] = $row["telephone"];

                $_SESSION["admin_account_update_success"] =
                    '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: monospace; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading"> Information Successfully Updated! </h5>
                </div>';
                header("location: ../views/admin-homepage.php");
                exit();
            }
        } else {
            return FALSE;
        }
    }
}
