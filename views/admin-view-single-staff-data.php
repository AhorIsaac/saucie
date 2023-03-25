<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!($_SESSION["admin_id"])) {
    header('location: users-login.php');
}

if (isset($_POST["submit_button"])) {
    $staff_id = $_POST["staff_id"];
    $staff = new Staff();
    $row = $staff->selectOneStaffInfo($staff_id);
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
    <link href="../public/css/staff-style.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #staff_frame {
            border: 1px solid antiquewhite;
            border-radius: 10px;
            font-family: monospace;
        }

        #staff_image {
            width: 200px;
            height: 200px;
            border-radius: 100px;
            border: 1px double orange;
        }

        #staff_frame h3 {
            font-family: monospace;
            color: white;
        }

        #staff_frame p {
            font-family: monospace;
            font-size: 20px;
            color: black;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center pt-3">
            <h1 class="text-center mt-4 mb-4" style="font-family: ubuntu mono;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h1>
        </header>

        <h3 class="text-center" style="font-family: Ubuntu Mono;"> Profile Information for Staff <?php echo $row["name"]; ?> </h3>

        <?php ?>
        <div class="jumbotron text-center shadow-lg bg-light justify-content-center" id="staff_frame">
            <div class="row justify-content-around text-center">
                <div class="col-md-3 col-lg-3">
                    <?php $im = $row["profileimage"]; ?>
                    <img src="../public/storage/staff_profileimage/<?php echo $im ?>" alt="pic" id="staff_image" class="shadow-md" />
                    <h3 class="text-dark m-3"> Staff <?php echo $row["name"]; ?> </h3>
                </div>
                <div class="col-md-3 col-lg-3">
                    <p class=""> <i class="fa fa-id-badge fa-1x"></i> ID : <?php echo $row["id"]; ?> </p>
                    <p class=""> <i class="fa fa-user-circle fa-1x"></i> Name : <?php echo $row["name"]; ?> </p>
                    <p class=""> <i class="fa fa-envelope fa-1x"></i> Email : <?php echo $row["email"]; ?> </p>
                    <p class=""> <i class="fa fa-phone fa-1x"></i> Telephone : <?php echo $row["telephone"]; ?> </p>
                    <p class=""> <i class="fa fa-user fa-1x"></i> Gender : <?php echo $row["gender"]; ?> </p>
                </div>
                <div class="col-md-3 col-lg-3">
                    <p class=""> <i class="fa fa-address-card fa-1x"></i> Address : <?php echo $row["address"]; ?> </p>
                    <p class=""> <i class="fa fa-calendar-alt fa-1x"></i> Date of Birth <?php echo $row["dob"]; ?> </p>
                    <p class=""> <i class="fa fa-star fa-1x"></i> Role : <?php echo $row["role"]; ?> </p>
                    <p class=""> <i class="fa fa-check-circle fa-1x"></i> Status : <?php
                                                                                    if ($row["status"] == 1) {
                                                                                        echo "Active";
                                                                                    } else {
                                                                                        echo "Inactive";
                                                                                    }
                                                                                    ?>
                    </p>
                    <p class=""> <i class="fa fa-money-bill-alt fa-1x"></i> Salary : <span> &#8358;</span><?php echo $row["SALARY"]; ?> </p>
                </div>
            </div>
            <a href="admin-view-all-staff.php" class="mt-2 mb-2 btn btn-outline-info">
                Return to Staff Information Page
            </a>
        </div>
        <?php ?>


        <footer class="text-center">
            <h3 class="text-center" style="font-family: ubuntu mono;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/staff-main.js"> </script>
</body>

</html>