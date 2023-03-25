<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

// function that checks if html input is empty
function checkIfEmpty($inputName)
{
    if (empty($inputName)) {
        session_start();
        $_SESSION['user_login_error'] =
            '<div class="alert alert-danger text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h6 class="alert-heading"> An Error Occurred! </h6>
                <p class=""> All input entries are required. </p>
            </div>';
        header("location: users-login.php");
        // exit();                            
    } else {
        return $inputName;
    }
}

// valid user email/account
// this function checks if the email is valid 
function checkValidUserEmail($email)
{
    $user = new User();
    $checkValidEmailOfUser = $user->validUserEmail($email);
    if ($checkValidEmailOfUser === FALSE) {
        session_start();
        $_SESSION["user_login_error"] =
            '<div class="alert alert-warning text-center alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading"> User not Found! </h6>
            <p class=""> Invalid User Account! <br />
            You are not a registered user of Saucie! </p>
        </div>';
        header("location: users-login.php");
        // exit();                            
    } else {
        return TRUE;
    }
}

if (isset($_POST["sign_in"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $email = checkIfEmpty($email);
    $password = checkIfEmpty($password);

    $userCheck = checkValidUserEmail($email);

    if ($userCheck === TRUE) {
        $passwordEncrpt = md5($password);
        $user = new User();
        $role = $user->userRole($email);


        // ************* trying to login the admin
        if (($role["role"] == "admin") || ($role["role"] == "super_admin")) {
            $admin = new Admin();
            $loginAdmin = $admin->loginAdminDetails($email, $passwordEncrpt);

            if ($loginAdmin == false) {
                session_start();
                $_SESSION["user_login_error"] =
                    '<div class="alert alert-danger alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
                        <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                        <h6 class="alert-heading"> Admin Login Unsuccessful! </h6>
                        <p> Wrong email/password combination </p>
                    </div>';
                header("location: users-login.php");
                exit();
            }
        }

        // ***************** trying to login the staff
        if (($role["role"] == "staff") || ($role["role"] == "super_staff")) {
            $staff = new Staff();
            $loginStaff = $staff->loginStaffDetails($email, $passwordEncrpt);

            if ($loginStaff == false) {
                session_start();
                $_SESSION["user_login_error"] =
                    '<div class="alert alert-danger alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h6 class="alert-heading"> Staff Login Unsuccessful! </h6>
                    <p> Wrong email/password combination </p>
                </div>';
                header("location: users-login.php");
                exit();
            }
        }


        // ********************* trying to login the customer 
        if ($role["role"] == "customer") {
            $customer = new Customer();
            $loginCustomer = $customer->loginCustomerDetails($email, $passwordEncrpt);

            if ($loginCustomer == FALSE) {
                session_start();
                $_SESSION["user_login_error"] =
                    '<div class="alert alert-danger alert-dismissible fade show" style="font-family: monospace; font-size: 14px; display: inline-block;">
                        <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                        <h6 class="alert-heading"> Login Unsuccessful! </h6>
                        <p> Wrong email/password combination </p>
                    </div>';
                header("location: users-login.php");
                exit();
            }
        }
        // *********************************************************

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
        #main {
            background: linear-gradient(90deg,
                    rgba(255, 255, 255, 0.5)25%,
                    rgba(255, 255, 255, 0.5)50%,
                    rgba(255, 255, 255, 0.5)75%,
                    rgba(255, 255, 255, 0.5)100%);
            border-radius: 35px;
            border: 2px solid orange;
            font-family: monospace;
        }

        body {
            background-image: url("../public/storage/FoodPix/bg-19.jpg");
            background-size: cover;
            background-attachment: fixed;
            font-family: monospace;
        }

        input[type="email"] {
            border: 1px solid orange;
            font-weight: bold;
        }

        #food_img {
            width: 500px;
            height: 300px;
            border-radius: 10px;
        }

        input[type="reset"],
        input[type="submit"],
        #su {
            border: 1px solid antiquewhite;
            font-family: monospace;
        }

        #password_div {
            background: white;
            border-radius: 6px;
            border: 1px solid orange;
        }

        input[type="password"] {
            border-right: none;
            font-weight: bold;
            font-family: monospace;
        }

        #pass-status1 {
            margin-top: 10px;
            font-size: 17px;
            border-left: none;
        }
    </style>
</head>

<body class=" bg-light">
    <div class="container-fluid pt-3 mt-3">
        <header class="text-center m-3 p-3">
            <h2 class="text-dark" style="font-size: 45px;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h2>
        </header>

        <div class="text-center">
            <?php if (isset($_SESSION["user_login_error"])) {
                echo $_SESSION["user_login_error"];
                unset($_SESSION["user_login_error"]);
            } ?>

            <?php if (isset($_SESSION["customer_register_success"])) {
                echo $_SESSION["customer_register_success"];
                unset($_SESSION["customer_register_success"]);
            } ?>
        </div>

        <div class="row justify-content-around">

            <div class="col-sm-5 p-3 m-3 shadow-lg" id="main">
                <h3 class="course-heading m-5 text-dark text-left">
                    <i class="fa fa-user fa-1x"></i> User Login
                </h3>

                <form method="POST">
                    <div class="form-group row">
                        <label for="email" class='col-form-label col-sm-1 text-center'> <i class="fa fa-envelope fa-1x"></i> </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="someone@example.com" name="email" value="<?php if (isset($_POST["email"])) {
                                                                                                                                echo $_POST["email"];
                                                                                                                            } ?>" required />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pass1" class='col-form-label col-sm-1 text-center'> <i class="fa fa-lock fa-1x"></i> </label>
                        <div class="col-sm-10">
                            <div class="input-group" id="password_div">
                                <input type="password" id="password-field1" class="form-control mr-0" placeholder="input your password " name="password" required />
                                <div class="input-group-append">
                                    <i id="pass-status1" class="fa fa-eye-slash fa-1x" aria-hidden="true" onClick="return viewPassword1()"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="buttons" class="col-form-label col-sm-3"> </label>
                        <div class='col-sm-9'>
                            <input type="reset" name="reset" value="Reset" class="btn btn-md btn-dark">
                            <input type="submit" class="btn btn-light btn-md" name="sign_in" value="Login">
                            <a href="customers-sign-up.php" class="btn btn-info btn-md shadow-sm" id="su">
                                Create account!
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <footer class="text-center m-3 p-3">
            <h3 class="text-center" style="color: black">
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
            var eye = document.getElementById('pass-status1');

            if (passwordInput.type == 'password') {
                passwordInput.type = 'text';
                eye.classList.toggle('fa-eye');

            } else {
                passwordInput.type = 'password';
                eye.classList.toggle('fa-eye-slash');
            }
        }
    </script>

</body>

</html>