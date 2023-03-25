<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!$_SESSION['staff_name']) {
    header("location: users-login.php");
}


$img = $_SESSION["staff_profileimage"];

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
            background-attachment: fixed;
            background-size: cover;
        }

        #staff_img {
            width: 130px;
            height: 130px;
            border-radius: 65px;
        }

        a[class="nav-link"] {
            color: orange;
            padding-left: 10px;
            padding-right: 10px;
        }

        .nav-link:hover {
            background-color: orange;
            color: black;
        }

        .image-frame {
            border: 1px solid antiquewhite;
            border-radius: 5px;
            box-shadow: 0 0 1px 1px antiquewhite;
            margin: auto;
        }

        #staffimg {
            width: 200px;
            height: 200px;
            border-radius: 100px;
            border: 1px solid antiquewhite;
            box-shadow: 0 0 1px 1px skyblue;
        }

        .my-info {
            font-weight: normal;
            font-size: 16px;
        }

        #img_carousel {
            width: 800px;
            height: 500px;
        }

        #icon_img {
            width: 30px;
            height: 30px;
            border-radius: 15px;
            border: 1px solid antiquewhite;
            box-shadow: 0 0 1px 1px antiquewhite;
        }

        #links a {
            font-weight: bold;
            font-family: monospace;
            border-radius: 15px;
        }

        #links {
            border: 1px dotted dimgray;
        }

        #logout_button {
            border-radius: 25px;

        }

        #img_carousel {
            width: 600px;
            height: 400px;
        }

        #carousel_slider {
            border: 2px solid antiquewhite;
        }

        #update_button {
            border-radius: 25px;
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-dark">

            <div class="align-items-center text-center">
                <img src="../public/storage/staff_profileimage/<?php echo $_SESSION["staff_profileimage"]; ?>" alt="" id="staff_img" class="mt-3" />
                <h5 class="text-light"> <?php if (isset($_SESSION["staff_name"])) {
                                            echo $_SESSION["staff_name"];
                                        } ?> </h5>
                <a href="../controllers/staff-logout.php" id="logout_button" class="btn-outline-primary p-2 shadow-lg border"> <i class="fa fa-power-off fa-1x"></i> Logout </a>
            </div>

            <div class="p-4 pt-4">

                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Saucie Restaurant </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="admin-view-all-admins.php"> <i class="fa fa-user-tie fa-1x"></i> Administrators </a>
                            </li>
                            <?php if (isset($_SESSION["staff_role"])) {
                                if ($_SESSION["staff_role"] == "super_staff") {
                                    echo '                            
                            <li>
                                <a href="#"> <i class="fa fa-pen fa-1x"></i> <i class="fa fa-book fa-1x"></i> Send Reports </a>
                            </li>';
                                }
                            } ?>
                            <li>
                                <a href="food-summary.php"> <i class="fa fa-book fa-1x"></i> Products Summary </a>
                            </li>
                        </ul>
                    </li>
                    <?php
                    $msg = new Message();
                    $num = $msg->assignOrderMessage($_SESSION["staff_id"]);
                    ?>
                    <?php if ($num != 0) {  ?>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#messageModal">
                                <i class="fa fa-comment-dots fa-1x"></i> Sent by <i class="fa fa-user-tie fa-1x"></i>
                                <span class="badge badge-pills text-dark badge-light " style="font-size: 14px">
                                    <?php echo $num; ?>
                                </span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fa fa-shopping-cart fa-1x"></i> Order
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="saucie-all-delivered-order.php">
                                    <i class="fa fa-check-square fa-1x"></i> Delivered Order
                                </a>
                            </li>
                            <li>
                                <a href="saucie-pending-order.php">
                                    <?php
                                    $ord = new Order();
                                    $pendingBreakfastNo = $ord->pendingOrderNumber("order_table_breakfast");
                                    $pendingLunchNo = $ord->pendingOrderNumber("order_table_lunch");
                                    $pendingDinnerNo = $ord->pendingOrderNumber("order_table_dinner");
                                    $pendingDrinksNo = $ord->pendingOrderNumber("order_table_drinks");

                                    $pnd = $pendingBreakfastNo + $pendingLunchNo + $pendingDinnerNo + $pendingDrinksNo;
                                    ?>
                                    <i class="fa fa-sort-amount-down fa-1x"></i> See All Pending Order
                                    <span class="badge badge-pill text-dark badge-light font-weight-bold" style="font-size: 14px">
                                        <?php echo $pnd; ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="food-homepage.php">
                            <i class="fa fa-table fa-1x"></i>
                            View Products
                        </a>
                    </li>
                    <li>
                        <a href="upload-products.php">
                            <i class="fa fa-upload"></i> Upload Saucie Products
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">

                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>

                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav text-center ml-auto">
                            <li class="nav-item active">
                                <a class="nav-link" href="#" data-toggle="modal" data-target="#profileModal">
                                    <i class="fa fa-address-card fa-1x"></i> View Profile
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="staff-change-password.php">
                                    <i class="fa fa-user-shield"></i> Change Password
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h2 class="mb-4"> Staff Homepage! </h2>

            <div class="text-center">

                <?php if (isset($_SESSION["staff_account_update_success"])) {
                    echo $_SESSION["staff_account_update_success"];
                    unset($_SESSION["staff_account_update_success"]);
                }
                ?>

                <?php if (isset($_SESSION["staff_change_pass_success"])) {
                    echo $_SESSION["staff_change_pass_success"];
                    unset($_SESSION["staff_change_pass_success"]);
                }
                ?>
            </div>


            <div class="row justify-content-around">
                <div class="col">

                    <div class="jumbotron text-center bg-white shadow-lg" id="carousel_slider">
                        <h3 class="m-3 text-primary font-weight-light"> The Beauty of Saucie Enterprise </h3>
                        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000">
                            <ol class="carousel-indicators">
                                <li data-target="#carousel-exampel-generic" data-slide-to="0" class="active"> </li>
                                <li data-target="#carousel-exampel-generic" data-slide-to="1"> </li>
                                <li data-target="#carousel-exampel-generic" data-slide-to="2"> </li>
                                <li data-target="#carousel-exampel-generic" data-slide-to="3"> </li>
                                <li data-target="#carousel-exampel-generic" data-slide-to="4"> </li>
                                <li data-target="#carousel-exampel-generic" data-slide-to="5"> </li>
                            </ol>

                            <div class="carousel-inner" role="listbox">
                                <div class="carousel-item active">
                                    <img src="../public/storage/food_images/restaurant-kitchen.jpg" alt="First Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Restaurant Kitchen </h2>
                                        <p> The <i class="fa fa-home fa-1x"></i> of proper diet and nutrition </p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="../public/storage/food_images/restaurant-1.jpg" alt="Second Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Restaurant </h2>
                                        <p> Very comforting and conducive! </p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="../public/storage/food_images/wine-shelve.jpg" alt="Third Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Wines </h2>
                                        <p> Always at your service! </p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="../public/storage/food_images/restaurant-4.jpg" alt="Third Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Restaurant </h2>
                                        <p> The best place to enjoy your meal! </p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="../public/storage/food_images/restaurant-kit.jpg" alt="Third Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Kitchen </h2>
                                        <p> The world best meals are made from this amazing complex </p>
                                    </div>
                                </div>

                                <div class="carousel-item">
                                    <img src="../public/storage/food_images/restaurant-kitche.jpg" alt="Third Slide" id="img_carousel" />
                                    <div class="carousel-caption">
                                        <h2> Saucie Wines </h2>
                                        <p> Always at your service! </p>
                                    </div>
                                </div>

                            </div>

                            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                                <i class="fa fa-arrow-alt-circle-left fa-2x text-primary"></i>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                                <i class="fa fa-arrow-alt-circle-right fa-2x text-primary"></i>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>

                </div>
            </div>



            <div class="modal fade text-center justify-content-center" id="profileModal">
                <div class="modal-dialog modal-lg" style="width: 90%">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h2 class="modal-title">
                                Profile Information for <?php echo $_SESSION["staff_name"]; ?>
                            </h2>
                            <button type="button" class="close" data-dismiss="modal"> <span> &times; </span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-sm-8 justify-content-around text-center" style="margin: auto">
                                    <img src="../public/storage/staff_profileimage/<?php echo $img ?>" alt="" id="staffimg" />
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="col-sm-4 my-info">
                                    <p class="text-info">
                                        <i class="fa fa-user-circle fa-1x"></i> Name : <?php echo $_SESSION["staff_name"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-envelope fa-1x"></i> Email : <?php echo $_SESSION["staff_email"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-phone fa-1x"></i> Telephone : <?php echo $_SESSION["staff_telephone"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-heart fa-1x"></i> Relationship Status :
                                        <?php echo $_SESSION["staff_rel_status"]; ?>
                                    </p>
                                </div>
                                <div class="col-sm-4 my-info">
                                    <p class="text-info">
                                        <i class="fa fa-user fa-1x"></i> Gender : <?php echo $_SESSION["staff_gender"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-address-card fa-1x"></i> Address : <?php echo $_SESSION["staff_address"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-calendar-alt fa-1x"></i> Date of Birth : <?php echo $_SESSION["staff_dob"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-check-circle fa-1x"></i> Status : <?php echo $_SESSION["staff_status"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-money-bill-alt fa-1x"></i> Salary : <span>&#8358;</span><?php echo $_SESSION["staff_salary"]; ?>
                                    </p>
                                </div>
                            </div>
                            <a class="btn btn-outline-info" href="staff-update-my-profile.php" id="update_button">
                                <i class="fa fa-user-edit fa-1x"></i> Update Profile
                            </a>
                        </div>
                        <div class="modal-footer text-left">
                            <h3 class="text-left">
                                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                            </h3>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="messageModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Message sent from Saucie Administrators </h5>
                            <button type="button" class="close" data-dismiss="modal"> <span> &times; </span> </button>
                        </div>
                        <div class="modal-body">
                            <?php
                            $order = new Order();
                            $selectRef = $order->selectReferenceNumbers($_SESSION["staff_id"]);
                            ?>
                            <p class='text-info'>
                                Deliver order with the following reference number(s) <br />
                                <?php
                                foreach ($selectRef as $ref) { ?>
                                    <b> <?php echo $ref["ref_no"] . '  '; ?> </b> <br />
                                <?php } ?>
                            </p>
                            <p class="text-muted">
                                You are there advised not to click the Order Delivered Button if the task handed to be is yet to be
                                accomplished!
                            </p>
                        </div>
                        <div class="modal-footer">
                            <a href="../controllers/staff-assign-order-delivered.php?staff_id=<?php echo $_SESSION["staff_id"]; ?>" class="btn btn-secondary">
                                Order Delivered
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="footer text-center">
                <h3 class="text-center text-secondary" style="font-family: monospace;">
                    <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise <br />
                </h3>
                <div class="">
                    <a href="#"> <img src="../public/project_icons/facebook.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/Instagram.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/skype.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/Twitter.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/youtube_flat.png" alt="" id="icon_img" class="m-1" /> </a>
                </div>
                <p> Copyright &copy;<script>
                        document.write(new Date().getFullYear());
                    </script> All rights reserved </p>
            </div>


        </div>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>

    <script src="../public/js/staff-main.js"> </script>

</body>

</html>