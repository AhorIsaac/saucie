<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!$_SESSION['admin_name']) {
    header("location: users-login.php");
}


$img = $_SESSION["admin_profileimage"];

?>

<!DOCTYPE html>
<html>

<head>
    <title> Saucie </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../public/css/litera-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../public/css/main-style.css" type="text/css" rel="stylesheet">
    <link href="../public/css/admin-style.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #admin_img {
            width: 140px;
            height: 140px;
            border-radius: 70px;
        }

        #item_images {
            width: 310px;
            height: 220px;
            border: 3px solid dimgray;
        }

        #icon_img {
            width: 30px;
            height: 30px;
            border-radius: 15px;
            border: 1px solid antiquewhite;
            box-shadow: 0 0 1px 1px antiquewhite;
        }

        #adimg {
            border-radius: 125px;
            width: 250px;
            height: 250px;
            border: 1px solid antiquewhite;
            box-shadow: 0 0 1px 1px skyblue;
        }

        #links a {
            border-radius: 15px;
            color: black;
            font-weight: bold;
        }

        #links {
            border: 1px dotted antiquewhite;
        }

        #logout_link {
            border-radius: 30px;
        }

        #img_carousel {
            width: 700px;
            height: 420px;
        }

        #carousel_slider {
            border: 1px solid antiquewhite;
            background-color: #333;
        }

        #logout_link:hover {
            color: black;
            background-color: white;
        }

        .carousel-item h2 {
            text-shadow: 2px 1px black;
            color: white;
            font-family: monospace;
        }

        .wrapper li:hover {
            transform: translate(12px, 0px);
            transition: transform 400ms ease-in-out;
        }

        #profileModal h4,
        #profileModal p,
        #profileModal a,
        #profileModal h3 {
            font-family: monospace;
            -webkit-font-family: monospace;
            -moz-font-family: monospace;
        }
    </style>
</head>

<body class="bg-light">

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-dark">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <div class="p-4">
                <div class="align-items-end text-center">
                    <img src="../public/storage/admin_profileimage/<?php echo $_SESSION["admin_profileimage"]; ?>" alt="" id="admin_img" />
                    <h6 class="m-2 mb-3 text-light"> <?php if (isset($_SESSION["admin_name"])) {
                                                            echo $_SESSION["admin_name"];
                                                        } ?> </h6>
                    <a href="../controllers/admin-logout.php" id="logout_link" class="p-2 mt-2 btn btn-dark btn-sm shadow-lg border"> <i class="fa fa-power-off fa-1x"></i> Logout </a>
                </div>
                <hr />

                <h1>
                    <a href="index.php" class="logo">
                        <i class="fa fa-cookie-bite fa-1x"></i> Saucie
                    </a>
                </h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="index.php">
                            <span class="fa fa-home mr-3"></span> Home
                        </a>
                    </li>

                    <li>
                        <a href="admin-view-all-admins.php">
                            <i class="fa fa-user-tie fa-1x"></i> Administrators
                        </a>
                    </li>

                    <li>
                        <a href="admin-view-all-staff.php">
                            <i class="fa fa-users fa-1x"></i> Staff
                        </a>
                    </li>

                    <li>
                        <a href="admin-view-all-users.php">
                            <i class="fa fa-user-friends fa-1x"></i> Users
                        </a>
                    </li>

                    <?php if (isset($_SESSION["admin_role"])) {
                        if ($_SESSION["admin_role"] == "super_admin") {
                            echo '                            
                        <li>
                            <a href="admin-sign-up.php">
                                <i class="fa fa-user-tie fa-1x"></i> <i class="fa fa-plus fa-1x"></i>
                                Add Admin
                            </a>
                        </li>';
                        }
                    } ?>

                    <li>
                        <a href="admin-add-staff.php">
                            <i class="fa fa-user-plus fa-1x"></i> Add Staff
                        </a>
                    </li>
                    <li>
                        <a href="admin-view-feedback.php">
                            <i class="fa fa-comments fa-1x"></i> Feedbacks
                            <?php
                            $msg = new Message();
                            $new_msg = $msg->unseenFeedbackNumber();
                            ?>
                            <span class="badge badge-pill badge-light text-dark font-weight-bold">
                                <?php if (isset($new_msg)) {
                                    echo $new_msg;
                                } else {
                                    echo 0;
                                } ?>
                            </span>
                        </a>
                    </li>
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
                            <i class="fa fa-sort-amount-down fa-1x"></i> Pending Order
                            <span class="badge badge-pill text-dark badge-light font-weight-bold" style="font-size: 14px">
                                <?php echo $pnd; ?>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#" data-toggle="modal" data-target="#profileModal">
                            <i class="fa fa-address-card fa-1x"></i>
                            View Profile
                        </a>
                    </li>
                    <li>
                        <a href="admin-change-my-password.php">
                            <i class="fa fa-user-shield"></i>
                            Change Password
                        </a>
                    </li>
                    <li>
                        <a href="food-homepage.php">
                            <i class="fa fa-table fa-1x"></i>
                            View Products
                        </a>
                    </li>
                </ul>
            </div>
        </nav>


        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">

            <div class="text-center">
                <?php

                if (isset($_SESSION["admin_register_success"])) {
                    echo $_SESSION["admin_register_success"];
                    unset($_SESSION["admin_register_success"]);
                }
                ?>

                <?php if (isset($_SESSION["admin_account_update_success"])) {
                    echo $_SESSION["admin_account_update_success"];
                    unset($_SESSION["admin_account_update_success"]);
                }
                ?>

                <?php if (isset($_SESSION["admin_change_pass_success"])) {
                    echo $_SESSION["admin_change_pass_success"];
                    unset($_SESSION["admin_change_pass_success"]);
                }
                ?>

                <?php if (isset($_SESSION["staff_register_success"])) {
                    echo $_SESSION["staff_register_success"];
                    unset($_SESSION["staff_register_success"]);
                } ?>
            </div>


            <h2 class="mb-4 font-weight-light"> Administrator's Homepage </h2>

            <div class="row justify-content-around">
                <div class="col">

                    <div class="jumbotron text-center shadow-lg bg-white" id="carousel_slider">
                        <h5 class="m-3 text-dark font-weight-light"> The Beauty of Saucie Enterprise </h5>
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




            <!-- ADMIN MODAL PROFILE INFORMATION -->
            <div class="modal fade" id="profileModal">
                <div class="modal-dialog modal-lg" style="width: 90%">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h4 class="modal-title">
                                Profile Information for Administrator <?php echo $_SESSION["admin_name"]; ?>
                            </h4>
                            <button type="button" class="close" data-dismiss="modal"> <span> &times; </span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-sm-8 justify-content-around text-center" style="margin: auto">
                                    <img src="../public/storage/admin_profileimage/<?php echo $img ?>" alt="" id="adimg" />
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="col-sm-4 my-info">
                                    <p class="text-info">
                                        <i class="fa fa-id-badge fa-1x"></i> ID : <?php echo $_SESSION["admin_id"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-user-circle fa-1x"></i> Name : <?php echo $_SESSION["admin_name"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-envelope fa-1x"></i> Email : <?php echo $_SESSION["admin_email"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-user-shield fa-1x"></i> Role : <?php echo $_SESSION["admin_role"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-phone fa-1x"></i> Telephone : <?php echo $_SESSION["admin_telephone"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-heart fa-1x"></i> Relationship Status :
                                        <?php echo $_SESSION["admin_rel_status"]; ?>
                                    </p>
                                </div>
                                <div class="col-sm-4 my-info">
                                    <p class="text-info">
                                        <i class="fa fa-user fa-1x"></i> Gender : <?php echo $_SESSION["admin_gender"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-address-card fa-1x"></i> Address : <?php echo $_SESSION["admin_address"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-calendar-alt fa-1x"></i> Date of Birth : <?php echo $_SESSION["admin_dob"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-star fa-1x"></i> Role : <?php echo $_SESSION["admin_role"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-check-circle fa-1x"></i> Status : <?php echo $_SESSION["admin_status"]; ?>
                                    </p>
                                    <p class="text-info">
                                        <i class="fa fa-money-bill-alt fa-1x"></i> Salary : <span>&#8358;</span> <?php echo $_SESSION["admin_salary"]; ?>
                                    </p>
                                </div>
                            </div>
                            <a href="admin-update-my-profile.php" class="btn btn-outline-info btn-md">
                                <i class="fa fa-user-edit fa-1x"></i>
                                Update Profile
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
            <!-- END OF ADMIN MODAL PROFILE INFORMATION -->



            <div class="footer">
                <h4 class="text-center">
                    <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                </h4>
                <div class="text-center">
                    <a href="#"> <img src="../public/project_icons/facebook.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/Instagram.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/skype.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/Twitter.png" alt="" id="icon_img" class="m-1" /> </a>
                    <a href="#"> <img src="../public/project_icons/youtube_flat.png" alt="" id="icon_img" class="m-1" /> </a>
                </div>
            </div>

        </div>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/main.js"> </script>
</body>

</html>