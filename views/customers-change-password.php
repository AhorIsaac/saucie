<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

$email = $_SESSION["cus_email"];

// function that checks if html input is empty
function checkIfEmpty($inputName)
{
    if (empty($inputName)) {
        session_start();
        $_SESSION["cus_change_password_error"] =
            '<div class="alert alert-danger alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
            <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h5 class="alert-heading"> Input Error </h5>
            <p>  All input entries are required! </p>
        </div>';
        header("location: customers-change-password.php");
        exit();
    } else {
        return $inputName;
    }
}

// function that checks if the two password entries match 
function passwordMatch($pass1, $pass2)
{
    if ($pass1 === $pass2) {
        return TRUE;
    } else {
        session_start();
        $_SESSION["cus_change_password_error"] =
            '<div class="alert alert-warning alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
            <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h5 class="alert-heading"> Password Mismatch Error </h5>
            <p>  New password entry 1 do not match entry 2! <br /> Input a matched password </p>
        </div>';
        header("location: customers-change-password.php");
        exit();
    }
}

// trying to change the password now
if (isset($_POST["change_password"])) {
    $id = $_SESSION["cus_id"];
    $oldpassword = $_POST["old_pass"];
    $newpassword1 = $_POST["new_pass_1"];
    $newpassword2 = $_POST["new_pass_2"];

    $oldpassword = checkIfEmpty($oldpassword);
    $newpassword1 = checkIfEmpty($newpassword1);
    $newpassword2 = checkIfEmpty($newpassword2);

    passwordMatch($newpassword1, $newpassword2);

    $oldPassEncrypt = md5($oldpassword);

    $customer = new Customer();
    $validOldPassword = $customer->checkOldValidCustomerPassword($oldPassEncrypt);

    if ($validOldPassword === TRUE) {
        $newpassword = md5($newpassword1);
        $cust = new Customer();
        $changePass = $cust->changeCustomerPassword($newpassword, $id);

        if ($changePass == TRUE) {

            $user = new User();
            $changeUserPassword = $user->changeUserPassword($email, $newpassword);
            // var_dump($changeUserPassword); exit();

            session_start();
            $_SESSION["cus_change_pass_success"] =
                '<div class="alert alert-success alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
                <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="alert-heading font-weight-bold"> Success </h5>
                <p class="font-weight-bold">  Customer\'s Password Changed Successfully! <br /> Welcome Back! </p>
            </div>';
            header("location: customers-homepage.php");
            exit();
        }
    } else {
        session_start();
        $_SESSION["cus_change_password_error"] =
            '<div class="alert alert-danger alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
            <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h5 class="alert-heading"> Wrong Old Password </h5>
            <p>  Customer\'s Password not changed! </p>
        </div>';
        header("location: customers-change-password.php");
        exit();
    }
}

?>


<!DOCTYPE html>
<html>

<head>
    <title> Saucie </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../public/css/litera-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        input[type='text'] {
            border: 1px solid white;
            font-family: monospace;
            font-weight: bold;
        }

        label {
            font-weight: bold;
        }

        #change_pass_form {
            border: 3px solid antiquewhite;
        }

        #proim {
            width: 150px;
            height: 150px;
            border-radius: 75px;
            border: 3px double dimgray;
        }

        #password_div {
            background: white;
            border-radius: 6px;
            border: 1px solid grey;
        }

        input[type="password"] {
            border-right: none;
            font-weight: bold;
            font-family: monospace;
        }

        #pass-status1,
        #pass-status2,
        #pass-status3 {
            margin-top: 10px;
            font-size: 17px;
            border-left: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center m-3 p-3">
            <h2 class="text-dark" style="font-size: 45px;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h2>
        </header>

        <div class="text-center">
            <?php if (isset($_SESSION["cus_change_password_error"])) {
                echo $_SESSION["cus_change_password_error"];
                unset($_SESSION["cus_change_password_error"]);
            }
            ?>
        </div>

        <form method="POST" class="jumbotron shadow-lg bg-white" id="change_pass_form">
            <h3 class="course-heading text-center text-dark font-weight-bold pb-4">
                Change Password for <?php echo $_SESSION["cus_name"]; ?> <br />
                <img src="../public/storage/customer_profileimage/<?php echo $_SESSION["cus_profileimage"]; ?>" alt="" id="proim" />
            </h3>
            <input type="hidden" value="<?php echo $_SESSION["cus_id"]; ?>" name="id" />

            <div class="form-group row">
                <label for="oldPassword" class="col-form-label col-sm-3"> <i class="fa fa-key"> </i> Old Password </label>
                <div class="col-sm-7">
                    <div class="input-group" id="password_div">
                        <input type="password" id="password-field1" class="form-control mr-0" placeholder="input old password " name="old_pass" required />
                        <div class="input-group-append" style="border: none; ">
                            <i id="pass-status1" class="fa fa-eye fa-1x" aria-hidden="true" onClick="return viewPassword1()"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="newPassword1" class="col-form-label col-sm-3"> <i class="fa fa-lock"> </i> New Password </label>
                <div class="col-sm-7">
                    <div class="input-group" id="password_div">
                        <input type="password" id="password-field2" class="form-control mr-0" placeholder="input new password " name="new_pass_1" required />
                        <div class="input-group-append" style="border: none; ">
                            <i id="pass-status2" class="fa fa-eye fa-1x" aria-hidden="true" onClick="return viewPassword2()"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="newPassword2" class="col-form-label col-sm-3"> <i class="fa fa-lock"> </i> Repeat New Password </label>
                <div class="col-sm-7">
                    <div class="input-group" id="password_div">
                        <input type="password" id="password-field3" class="form-control mr-0" placeholder="repeat new password " name="new_pass_2" required />
                        <div class="input-group-append" style="border: none; ">
                            <i id="pass-status3" class="fa fa-eye fa-1x" aria-hidden="true" onClick="return viewPassword3()"></i>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row">
                <label for="buttons" class="col-form-label col-sm-2"> </label>
                <div class="col-sm-6">
                    <input type="reset" class="btn btn-outline-warning" value="Reset" name="reset" />
                    <input class="btn btn-outline-info" name="change_password" type="submit" value="Change Password">
                    <a href="customers-homepage.php" class='btn btn-outline-dark' name="dont-change">
                        <i class="fa fa-power-off fa-1x"></i> Quit
                    </a>
                </div>
            </div>
        </form>


        <footer class="text-center">
            <h3 class="text-center">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script>
        function viewPassword1() {
            var passwordInput = document.getElementById('password-field1');
            var passStatus = document.getElementById('pass-status1');

            if (passwordInput.type == 'password') {
                passwordInput.type = 'text';
                passStatus.classList.toggle('fa-eye-slash');

            } else {
                passwordInput.type = 'password';
                passStatus.classList.toggle('fa-eye');
            }
        }

        function viewPassword2() {
            var passwordInput = document.getElementById('password-field2');
            var passStatus = document.getElementById('pass-status2');

            if (passwordInput.type == 'password') {
                passwordInput.type = 'text';
                passStatus.classList.toggle('fa-eye-slash');

            } else {
                passwordInput.type = 'password';
                passStatus.classList.toggle('fa-eye');
            }
        }

        function viewPassword3() {
            var passwordInput = document.getElementById('password-field3');
            var passStatus = document.getElementById('pass-status3');

            if (passwordInput.type == 'password') {
                passwordInput.type = 'text';
                passStatus.classList.toggle('fa-eye-slash');

            } else {
                passwordInput.type = 'password';
                passStatus.classList.toggle('fa-eye');
            }
        }
    </script>

</body>

</html>