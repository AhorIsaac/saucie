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
        $_SESSION['customer_registration_error'] =
            '<div class="alert alert-danger text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h6 class="alert-heading"> An Error Occurred! </h6>
                <p class=""> All input entries are required. </p>
            </div>';
        header("location: customers-sign-up.php");
        exit();
    } else {
        return $inputName;
    }
}

function checkIfPasswordsMatch($pass1, $pass2)
{
    if ($pass1 === $pass2) {
        return TRUE;
    } else {
        session_start();
        $_SESSION['customer_registration_error'] =
            '<div class="alert alert-danger text-center alert-dismissible fade show " style="font-family:  monospace; font-size: 14px; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h6 class="alert-heading"> Password Mismatch Error! </h6>
                <p class=""> Password input must have the same entry values. <br />
                    Registration failed due to password mismatch
                </p>
            </div>';
        header("location: customers-sign-up.php");
        exit();
    }
}

function checkIfAccountExist($email)
{
    $customer = new Customer();
    $accountFound = $customer->validCustomerEmail($email);
    if ($accountFound == TRUE) {
        session_start();
        $_SESSION['customer_registration_error'] =
            '<div class="alert alert-warning text-center alert-dismissible fade show " style="font-family:  monospace; font-size: 14px; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h6 class="alert-heading">  Account Already Exist! </h6>
                <p class=""> This customer has already registered with Saucie <br />
                    Registration not successful!
                </p>
            </div>';
        header("location: customers-sign-up.php");
        exit();
    } else {
        return FALSE;
    }
}

if (isset($_POST["sign_up"])) {
    $name = $_POST["username"];
    $email = $_POST["email"];
    $password1 = $_POST["password1"];
    $password2 = $_POST["password2"];

    $telephone = $_POST["telephone"];
    $address = $_POST["address"];


    $name = checkIfEmpty($name);
    $email = checkIfEmpty($email);
    $password1 = checkIfEmpty($password1);
    $password2 = checkIfEmpty($password2);

    $telephone = checkIfEmpty($telephone);
    $address = checkIfEmpty($address);


    // check if the two password entries match
    $passwordMatch = checkIfPasswordsMatch($password1, $password2);

    if ($passwordMatch === TRUE) {
        // check if the customer already has an account
        $accountAlreadyExist = checkIfAccountExist($email);

        if ($accountAlreadyExist === FALSE) {
            $fields = [
                "name" => $name,
                "email" => $email,
                "password" => md5($password1),
                "telephone" => $telephone,
                "address" => $address
            ];


            $role = "customer";
            $user_fields = [
                "name" => $name,
                "email" => $email,
                "password" => md5($password1),
                "role" => $role
            ];
            $user = new User();
            $user_registration = $user->registerUser($user_fields);


            $customer = new Customer();
            $customer->registerCustomer($fields);
        }
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
                    rgba(255, 255, 255, 0.4)25%,
                    rgba(255, 255, 255, 0.4)50%,
                    rgba(255, 255, 255, 0.4)75%,
                    rgba(255, 255, 255, 0.4)100%);
            border-radius: 35px;
            border: 1px dotted orange;
        }

        body {
            font-family: monospace;
            background-image: url("../public/storage/FoodPix/bg-19.jpg");
            background-attachment: fixed;
            background-size: cover;

        }

        input[type="email"],
        input[type="text"] {
            border: 1px solid orange;
            font-weight: bold;
        }

        #food_img {
            width: 500px;
            height: 400px;
            border-radius: 10px;
        }

        input[type="submit"],
        input[type="reset"],
        input[type="date"],
        input[type="file"],
        #su {
            font-weight: bold;
            font-family: monospace;
            border: 1px solid antiquewhite;
        }

        i[type="fa"] {
            color: antiquewhite;
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

        #pass-status1,
        #pass-status2 {
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
            <?php if (isset($_SESSION['customer_registration_error'])) {
                echo $_SESSION['customer_registration_error'];
                unset($_SESSION['customer_registration_error']);
            } ?>
        </div>

        <div class="row justify-content-around">

            <div class="col-sm-6 col-md-6 col-lg-6 p-3 m-3 shadow-lg" id="main">
                <h4 class="course-heading m-5 text-dark text-left">
                    <i class="fa fa-user-circle fa-1x"></i> User Registration Page
                </h4>

                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                        <label for="username" class="col-form-label col-sm-1 text-center">
                            <i class="fa fa-user fa-1x"></i>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Create Username" name="username" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class='col-form-label col-sm-1 text-center'> <i class="fa fa-envelope fa-1x"></i> </label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" placeholder="someone@example.com" name="email" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pass1" class='col-form-label col-sm-1 text-center'> <i class="fa fa-lock fa-1x"></i> </label>
                        <div class="col-sm-10">
                            <div class="input-group" id="password_div">
                                <input type="password" id="password-field1" class="form-control mr-0" placeholder="create password " name="password1" required />
                                <div class="input-group-append">
                                    <i id="pass-status1" class="fa fa-eye fa-1x" aria-hidden="true" onClick="return viewPassword1()"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="pass2" class='col-form-label col-sm-1 text-center'> <i class="fa fa-key fa-1x"></i> </label>
                        <div class="col-sm-10">
                            <div class="input-group" id="password_div">
                                <input type="password" id="password-field2" class="form-control mr-0" placeholder="repeat password " name="password2" required />
                                <div class="input-group-append">
                                    <i id="pass-status2" class="fa fa-eye fa-1x" aria-hidden="true" onClick="return viewPassword2()"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="telephone" class='col-form-label col-sm-1 font-weight-bold'>
                            <i class="fa fa-phone fa-1x"></i>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Input Telephone Number" name="telephone" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class='col-form-label col-sm-1 font-weight-bold'>
                            <i class="fa fa-address-card fa-1x"></i>
                        </label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" placeholder="Input Address" name="address" />
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="buttons" class="col-form-label col-sm-1"> </label>
                        <div class='col-sm-11'>
                            <input type="reset" name="reset" value="Reset" class="btn btn-md btn-dark">
                            <input type="submit" class="btn btn-light btn-md" name="sign_up" value="Register">
                            <a href="users-login.php" class="btn btn-info btn-md shadow-sm" id="su">
                                Already have an account!
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <footer class="text-center mt-3 mb-3">
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
                passStatus.classList.toggle('fa fa-eye');
            }
        }
    </script>
</body>

</html>