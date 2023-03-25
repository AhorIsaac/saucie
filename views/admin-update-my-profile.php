<?php
session_start();
function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!($_SESSION["admin_id"])) {
    header("location: users-login.php");
}

if (isset($_SESSION["admin_id"])) {
    $admin_id = $_SESSION["admin_id"];
    $new_admin = new Admin();
    $getData = $new_admin->selectOneAdminInfo($admin_id);
}


if (isset($_POST["update"])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $telephone = $_POST["telephone"];
    $rel_status = $_POST["rel_status"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $dob = $_POST["dob"];
    $status = $_POST['status'];
    $role = $_POST["role"];

    $profileimage = time() . '_' . $_FILES['profileimage']['name'];
    $target_dir = "admin_profileimage/";
    $target_file = $target_dir . basename($_FILES['profileimage']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));


    $fields = [
        "name" => $name,
        "email" => $email,
        "telephone" => $telephone,
        "rel_status" => $rel_status,
        "gender" => $gender,
        "dob" => $dob,
        "address" => $address,
        "status" => $status,
        "role" => $role,
        "profileimage" => $profileimage
    ];


    $user = new User();
    $user_fields = [
        "name" => $name,
        "email" => $email
    ];

    $userId = $user->getUserId($email);
    $user_id = $userId["id"];

    // var_dump($user_id); exit();

    $updateUser = $user->updateUserAccount($user_fields, $user_id);

    // var_dump($updateUser); exit();        


    move_uploaded_file($_FILES['profileimage']['tmp_name'], $target_dir . $profileimage);
    $update_admin = new Admin();
    $update_admin_information = $update_admin->updateAdminInfo($fields, $id);

    if ($update_admin_information === TRUE) {
        $updated_details = $update_admin->getUpdatedDetails($email);
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

        input[type="email"],
        input[type="text"],
        input[type="number"],
        input[type="file"] {
            border: 1px solid gray;
            font-weight: bold;
        }

        #food_img {
            width: 500px;
            height: 300px;
            border-radius: 10px;
        }

        #admin_frame {
            border: 1px solid antiquewhite;
            border-radius: 18px;
        }

        #proim {
            width: 150px;
            height: 150px;
            border-radius: 75px;
            border: 3px double dimgray;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container pt-3 mt-3">
        <header class="text-center m-3 p-3">
            <h3 class="text-dark" style="font-size: 45px;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h3>
        </header>


        <h2 class="text-center" id="up"> Admin Update Information Page </h2>
        <div class="jumbotron bg-light shadow-lg" id="admin_frame">
            <h3 class="text-center"> <?php $im = $getData["profileimage"]; ?>
                <img src="../public/storage/admin_profileimage/<?php echo $im ?>" alt="pic" id="proim" />
                <p class='font-weight-bold' style="font-family: monospace;">
                    Administrator <?php echo  $getData["name"]; ?> </p>
            </h3> <br />
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $getData["id"]; ?>">
                <input type="hidden" name="role" value="<?php echo $getData["role"]; ?>">

                <div class="form-group row">
                    <label for="userName" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-user fa-1x"></i> Username
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" placeholder="Input Username" name="name" value="<?php echo $getData["name"]; ?>" />
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-envelope fa-1x"></i> Email
                    </label>
                    <div class="col-sm-7">
                        <input type="email" class="form-control" placeholder="someone@example.com" name="email" value="<?php echo $getData["email"]; ?>" />
                    </div>
                </div>


                <div class="form-group row">
                    <label for="telephone" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-phone fa-1x"></i> Telephone
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" placeholder="+xxx-xxxx-xxxx-xxx" name="telephone" value="<?php echo $getData["telephone"]; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rel_status" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-heart fa-1x"></i> Relationship Status
                    </label>
                    <div class="col-sm-7">
                        <select class='form-control' name="rel_status">
                            <option value="Single" selected> Single </option>
                            <option value="Married"> Married </option>
                            <option value="Divorced"> Divorced </option>
                            <option value="Engaged"> Engaged </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rel_status" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-user fa-1x"></i> Gender
                    </label>
                    <div class="col-sm-7">
                        <label class="mr-3">
                            <input type="radio" class="mr-1" name="gender" value="M"> Male
                        </label>
                        <label class="mr-3">
                            <input type="radio" class="mr-1" name="gender" value="F"> Female
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-address-card fa-1x"></i> Address
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" placeholder="Address" name="address" value="<?php echo $getData["address"]; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="calendar" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-calendar-alt fa-1x"></i> Date of Birth
                    </label>
                    <div class="col-sm-7">
                        <input type="date" class="form-control" placeholder="Date of Birth" name="dob" value="<?php echo $getData["dob"]; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="rel_status" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-check-circle fa-1x"></i> Status
                    </label>
                    <div class="col-sm-7">
                        <select class='form-control' name="status">
                            <option value="1" selected> Active User </option>
                            <option value="0"> Inactive User </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="calendar" class='col-form-label col-sm-3 font-weight-bold'>
                        <i class="fa fa-money-bill-alt fa-1x"></i> Salary
                    </label>
                    <div class="col-sm-7 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold" id="basic-addon1">&#8358;</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Salary" name="salary" value="<?php echo $getData["salary"]; ?>" disabled />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="profilePhoto" class='col-form-label col-sm-3 font-weight-bold'> Profile <i class="fas fa-image fa-1x"></i> </label>
                    <div class='col-sm-7'>
                        <input type="file" name="profileimage" class="form-control" placeholder="Select Image" accept="image/*" value="admin_profileimage/<?php echo $getData["profileimage"]["name"]; ?>" />
                    </div>
                </div>

                <div class="form-group row">
                    <label for="buttons" class="col-form-label col-sm-3"> </label>
                    <div class='col-sm-7'>
                        <button type="submit" class="btn btn-success btn-sm" name="update">
                            <i class="fa fa-sync fa-2x"></i> Update
                        </button>
                        <a href="admin-homepage.php" class="btn btn-info btn-sm text-dark font-weight-bold">
                            <i class="fa fa-arrow-left fa-2x"> </i> Return
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <footer class="text-center">
            <h3 class="text-center">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
</body>

</html>