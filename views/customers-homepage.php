<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!$_SESSION['cus_name']) {
    header("location: users-login.php");
}


$img = $_SESSION["cus_profileimage"];

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
    <link href="../public/css/main.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #cus_img {
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

        #breakfast_image {
            width: 250px;
            height: 160px;
            border-radius: 20px;
        }

        #breakfast,
        #lunch,
        #dinner,
        #drinks {
            border: 1px solid dimgray;
            border-radius: 10px;
        }

        #breakfast a,
        #lunch a,
        #dinner a,
        #drinks a {
            border-radius: 20px;
        }

        #breakfast p {
            color: black;
        }

        #lunch p {
            color: black;
        }

        #dinner p {
            color: black;
        }

        #drinks p {
            color: black;
        }

        #cusimg {
            width: 250px;
            height: 250px;
            border-radius: 125px;
            border: 1px solid antiquewhite;
        }

        #links a {
            font-family: monospace;
            font-weight: bold;
            border-radius: 15px;
        }

        #logout_button {
            border-radius: 25px;
            color: white;
        }

        #logout_button:hover {
            color: black;
            background: white;
        }

        #food_img {
            width: 220px;
            height: 120px;
            border-radius: 8px;

        }

        #breakfast_frame {
            margin-left: 4px;
            margin-right: 4px;
            padding-bottom: 4px;
            padding-top: 8px;
            border: 2px solid antiquewhite;
            border-radius: 10px;
            font-family: Arial;
        }

        #breakfast_frame p,
        #breakfast_frame label {
            color: black;
        }

        #breakfast_frame input[type="number"] {
            width: 80px;
            color: black;
            font-weight: bold;
            border: 1px solid antiquewhite;
        }

        @media screen and (max-device-width: 480px) {
            #breakfast_frame {
                width: 100%;
            }
        }

        #breakfast_frame button {
            border-radius: 25px;
        }

        #update_button {
            border-radius: 25px;
        }

        .wrapper li:hover {
            transform: translate(12px, 0px);
            transition: transform 400ms ease-in-out;
        }
    </style>
</head>

<body onload="return showBreakfast();">


    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-dark">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>

            <div class="p-4" style="font-family: monospace;">

                <div class="mb-5">
                    <div class="text-center">
                        <img src="../public/storage/customer_profileimage/<?php echo $_SESSION["cus_profileimage"]; ?>" alt="" id="cus_img" />
                        <h5 class="text-light"> <?php if (isset($_SESSION["cus_name"])) {
                                                    echo $_SESSION["cus_name"];
                                                } ?> </h5>
                        <a href="../controllers/customers-logout.php" class=" p-2 border" id="logout_button"> <i class="fa fa-power-off fa-1x"></i> Logout </a>
                    </div>
                </div>

                <h1 class="mb-0">
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
                        <a href="send-feedback.php">
                            <i class="fa fa-comments fa-1x"></i> Send Feedbacks
                        </a>
                    </li>
                    <li>
                        <a href="customers-order-delivered.php">
                            <i class="fa fa-check-square fa-1x"></i>
                            <i class="fa fa-cart-arrow-down fa-1x"></i>
                            Delivered Order
                        </a>
                    </li>
                    <li>
                        <a href="customers-order-pending.php">
                            <?php
                            $order = new Order();
                            $pendBreakfast = $order->pendingBreakfastNumber($_SESSION["cus_id"]);
                            $pendLunch = $order->pendingLunchNumber($_SESSION["cus_id"]);
                            $pendDinner = $order->pendingDinnerNumber($_SESSION["cus_id"]);
                            $pendDrinks = $order->pendingDrinksNumber($_SESSION["cus_id"]);

                            $num = $pendBreakfast + $pendLunch + $pendDinner + $pendDrinks;
                            ?>
                            <i class="fa fa-sort-amount-down fa-1x"></i>
                            <i class="fa fa-cart-arrow-down fa-1x"></i>
                            Pending Order
                            <span class="badge badge-pill text-dark badge-light" style="font-size: 14px">
                                <?php echo $num; ?>
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
                        <a href="customers-change-password.php">
                            <i class="fa fa-user-shield"></i>
                            Change Password
                        </a>
                    </li>
                </ul>

            </div>
        </nav>


        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">

            <div class="text-center">

                <?php /*
                if(isset($_SESSION["customer_login_success"])) { 
                echo $_SESSION["customer_login_success"]; unset($_SESSION["customer_login_success"]); }
                */
                ?>

                <?php
                if (isset($_SESSION["process_success"])) {
                    unset($_SESSION["process_success"]);
                }

                if (isset($_SESSION["update_success"])) {
                    echo $_SESSION["update_success"];
                    unset($_SESSION["update_success"]);
                }

                if (isset($_SESSION['no_delivered_order'])) {
                    echo $_SESSION['no_delivered_order'];
                    unset($_SESSION['no_delivered_order']);
                }

                if (isset($_SESSION['no_pending_order'])) {
                    echo $_SESSION['no_pending_order'];
                    unset($_SESSION['no_pending_order']);
                }

                if (isset($_SESSION['feedback_success'])) {
                    echo $_SESSION['feedback_success'];
                    unset($_SESSION['feedback_success']);
                }

                if (isset($_SESSION["order_success"])) {
                    echo $_SESSION["order_success"];
                    unset($_SESSION["order_success"]);
                }

                if (isset($_SESSION["customer_account_update_success"])) {
                    echo $_SESSION["customer_account_update_success"];
                    unset($_SESSION["customer_account_update_success"]);
                }
                ?>

                <?php if (isset($_SESSION["cus_change_pass_success"])) {
                    echo $_SESSION["cus_change_pass_success"];
                    unset($_SESSION["cus_change_pass_success"]);
                } ?>
            </div>

            <h2 class="mb-4"> Customer's Homepage </h2>
            <div class="jumbotron text-center shadow bg-white" id="links">
                <a href="#" class="btn btn-outline-info m-2" onclick="return showBreakfast();"> Breakfast Section </a>
                <a href="#" class="btn btn-outline-info m-2" onclick="return showLunch();"> Lunch Section </a>
                <a href="#" class="btn btn-outline-info m-2" onclick="return showDinner();"> Dinner Section </a>
                <a href="#" class="btn btn-outline-info m-2" onclick="return showDrinks();"> Drinks Section </a>
            </div>

            <!-- ALL ABOUT BREAKFAST FRAME -->

            <div class="container-fluid  mb-4 shadow-lg bg-white" id="breakfast">
                <h3 class="text-center" style="font-family: monospace;"> Breakfast Section </h3>
                <div class="row justify-content-around">
                    <?php
                    $number = random_int(1, 18);

                    $breakfast = new Food();
                    $breakfastmeals = $breakfast->selectFourMeals('Breakfast', $number); ?>

                    <?php foreach ($breakfastmeals as $breakfastmeal) {  ?>

                        <div class="col-md-3 text-center mb-3 mt-3 shadow bg-white" id="breakfast_frame" style="min-width: 200px;">
                            <img class="card-img-top mt-1" src="../public/storage/uploaded_food/<?php echo $breakfastmeal["image"]; ?>" alt="" id="food_img">
                            <div class="text-center" style="font-family: ubuntu mono;">
                                <h4 class="" style="font-family: ubuntu mono" ;>
                                    <span style="font-family: ubuntu mono; font-weight: bold"> </span> <?php echo $breakfastmeal["name"]; ?>
                                </h4>
                                <p class="" style="font-size: 18px;"> <span style="font-family: ubuntu mono; font-weight: bold"> Price Tag </span> :
                                    <span> &#8358; </span> <?php echo $breakfastmeal["price_tag"]; ?>
                                </p>
                                <form class="form text-center form-submit" method="POST" action="../controllers/add-to-breakfast-cart.php">
                                    <input type="hidden" class="pid" name="food_id" value="<?php echo $breakfastmeal["id"]; ?>">
                                    <input type="hidden" class="" name="user_id" value="<?php echo $_SESSION["cus_id"]; ?>">
                                    <div class="form-group row justify-content-around text-center">
                                        <label for="quantity" style="font-size: 18px;" class="col-form-label col-sm-3">
                                            <span style="font-family: ubuntu mono; font-weight: bold"> Quantity </span>
                                        </label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control pquantity" required name="quantity" value="1" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info btn-md " name="addToCart">
                                            <i class="fa fa-cart-plus fa-1x"></i> Add to Cart
                                        </button>
                                        <a href="food-view-single-food-data.php?id=<?php echo $breakfastmeal["id"]; ?>" class="btn btn-outline-success btn-md">
                                            <i class="fa fa-book fa-1x"></i> Details
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php  } ?>
                </div>

                <div class="text-center mb-3 mt-3">
                    <a href='food-breakfast.php' class="btn btn-outline-secondary btn-md text-center  font-weight-bold" style="font-family: monospace; color: black">
                        <i class="fa fa-cart-arrow-down fa-1x"> </i> Order for More Breakfast Meals
                    </a>
                </div>
            </div>


            <!-- ALL ABOUT LUNCH FRAME -->


            <div class="container-fluid  mb-4 shadow-lg bg-white" id="lunch">
                <h3 class="text-center" style="font-family: monospace;"> Lunch Section </h3>
                <div class="row justify-content-around">
                    <?php
                    $number = random_int(1, 18);

                    $lunch = new Food();
                    $lunchmeals = $lunch->selectFourMeals('Lunch', $number); ?>

                    <?php foreach ($lunchmeals as $lunchmeal) {  ?>

                        <div class="col-md-3 text-center mb-3 mt-3 shadow bg-white" id="breakfast_frame" style="min-width: 200px;">
                            <img class="card-img-top mt-1" src="../public/storage/uploaded_food/<?php echo $lunchmeal["image"]; ?>" alt="" id="food_img">
                            <div class="text-center" style="font-family: ubuntu mono;">
                                <h4 class="" style="font-family: ubuntu mono" ;>
                                    <span style="font-family: ubuntu mono; font-weight: bold"> </span> <?php echo $lunchmeal["name"]; ?>
                                </h4>
                                <p class="" style="font-size: 18px;"> <span style="font-family: ubuntu mono; font-weight: bold"> Price Tag </span> :
                                    <span> &#8358; </span> <?php echo $lunchmeal["price_tag"]; ?>
                                </p>
                                <form class="form text-center form-submit" method="POST" action="../controllers/add-to-lunch-cart.php">
                                    <input type="hidden" class="pid" name="food_id" value="<?php echo $lunchmeal["id"]; ?>">
                                    <input type="hidden" class="" name="user_id" value="<?php echo $_SESSION["cus_id"]; ?>">
                                    <div class="form-group row justify-content-around text-center">
                                        <label for="quantity" style="font-size: 18px;" class="col-form-label col-sm-3">
                                            <span style="font-family: ubuntu mono; font-weight: bold"> Quantity </span>
                                        </label>
                                        <div class="col-sm-4 text-center">
                                            <input type="number" class="form-control pquantity" required name="quantity" value="1" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info btn-md " name="addToCart">
                                            <i class="fa fa-cart-plus fa-1x"></i> Add to Cart
                                        </button>
                                        <a href="food-view-single-food-data.php?id=<?php echo $lunchmeal["id"]; ?>" class="btn btn-outline-success btn-md">
                                            <i class="fa fa-book fa-1x"></i> Details
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php  } ?>
                </div>

                <div class="text-center mb-3 mt-3">
                    <a href='food-lunch.php' class="btn btn-outline-secondary btn-md text-center  font-weight-bold" style="font-family: monospace; color: black">
                        <i class="fa fa-cart-arrow-down fa-1x"> </i> Order for More Lunch Meals
                    </a>
                </div>
            </div>


            <!-- ALL ABOUT DINNER FRAME -->


            <div class="container-fluid  mb-4 shadow-lg bg-white" id="dinner">
                <h3 class="text-center" style="font-family: monospace;"> Dinner Section </h3>
                <div class="row justify-content-around">
                    <?php
                    $number = random_int(1, 18);

                    $dinner = new Food();
                    $dinnermeals = $dinner->selectFourMeals('Dinner', $number); ?>

                    <?php foreach ($dinnermeals as $dinnermeal) {  ?>

                        <div class="col-md-3 text-center mb-3 mt-3 shadow bg-white" id="breakfast_frame" style="min-width: 200px;">
                            <img class="card-img-top mt-1" src="../public/storage/uploaded_food/<?php echo $dinnermeal["image"]; ?>" alt="" id="food_img">
                            <div class="text-center" style="font-family: ubuntu mono;">
                                <h4 class="" style="font-family: ubuntu mono" ;>
                                    <span style="font-family: ubuntu mono; font-weight: bold"> </span> <?php echo $dinnermeal["name"]; ?>
                                </h4>
                                <p class="" style="font-size: 18px;"> <span style="font-family: ubuntu mono; font-weight: bold"> Price Tag </span> :
                                    <span> &#8358; </span> <?php echo $dinnermeal["price_tag"]; ?>
                                </p>
                                <form class="form text-center form-submit" method="POST" action="../controllers/add-to-dinner-cart.php">
                                    <input type="hidden" class="pid" name="food_id" value="<?php echo $dinnermeal["id"]; ?>">
                                    <input type="hidden" class="" name="user_id" value="<?php echo $_SESSION["cus_id"]; ?>">
                                    <div class="form-group row justify-content-around text-center">
                                        <label for="quantity" style="font-size: 18px;" class="col-form-label col-sm-3">
                                            <span style="font-family: ubuntu mono; font-weight: bold"> Quantity </span>
                                        </label>
                                        <div class="col-sm-4 text-center">
                                            <input type="number" class="form-control pquantity" required name="quantity" value="1" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info btn-md " name="addToCart">
                                            <i class="fa fa-cart-plus fa-1x"></i> Add to Cart
                                        </button>
                                        <a href="food-view-single-food-data.php?id=<?php echo $dinnermeal["id"]; ?>" class="btn btn-outline-success btn-md">
                                            <i class="fa fa-book fa-1x"></i> Details
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php  } ?>
                </div>

                <div class="text-center mb-3 mt-3">
                    <a href='food-dinner.php' class="btn btn-outline-secondary btn-md text-center  font-weight-bold" style="font-family: monospace; color: black">
                        <i class="fa fa-cart-arrow-down fa-1x"> </i> Order for More Dinner Meals
                    </a>
                </div>
            </div>



            <!-- ALL ABOUT DRINKS FRAME -->




            <div class="container-fluid  mb-4 shadow-lg bg-white" id="drinks">
                <h3 class="text-center" style="font-family: monospace;"> Drinks Section </h3>
                <div class="row justify-content-around">
                    <?php
                    $number = random_int(1, 18);

                    $wine = new Food();
                    $drinks = $wine->selectFourMeals('Drinks', $number); ?>

                    <?php foreach ($drinks as $drink) {  ?>

                        <div class="col-md-3 text-center mb-3 mt-3 shadow bg-white" id="breakfast_frame" style="min-width: 200px;">
                            <img class="card-img-top mt-1" src="../public/storage/uploaded_food/<?php echo $drink["image"]; ?>" alt="" id="food_img">
                            <div class="text-center" style="font-family: ubuntu mono;">
                                <h4 class="" style="font-family: ubuntu mono" ;>
                                    <span style="font-family: ubuntu mono; font-weight: bold"> </span> <?php echo $drink["name"]; ?>
                                </h4>
                                <p class="" style="font-size: 18px;"> <span style="font-family: ubuntu mono; font-weight: bold"> Price Tag </span> :
                                    <span> &#8358; </span> <?php echo $drink["price_tag"]; ?>
                                </p>
                                <form class="form text-center form-submit" method="POST" action="../controllers/add-to-drinks-cart.php">
                                    <input type="hidden" class="pid" name="food_id" value="<?php echo $drink["id"]; ?>">
                                    <input type="hidden" class="" name="user_id" value="<?php echo $_SESSION["cus_id"]; ?>">
                                    <div class="form-group row justify-content-around text-center">
                                        <label for="quantity" style="font-size: 18px;" class="col-form-label col-sm-3">
                                            <span style="font-family: ubuntu mono; font-weight: bold"> Quantity </span>
                                        </label>
                                        <div class="col-sm-4 text-center">
                                            <input type="number" class="form-control pquantity" required name="quantity" value="1" required />
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-outline-info btn-md " name="addToCart">
                                            <i class="fa fa-cart-plus fa-1x"></i> Add to Cart
                                        </button>
                                        <a href="food-view-single-food-data.php?id=<?php echo $drink["id"]; ?>" class="btn btn-outline-success btn-md">
                                            <i class="fa fa-book fa-1x"></i> Details
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php  } ?>
                </div>

                <div class="text-center mb-3 mt-3">
                    <a href='food-drinks.php' class="btn btn-outline-secondary btn-md text-center  font-weight-bold" style="font-family: monospace; color: black">
                        <i class="fa fa-cart-arrow-down fa-1x"> </i> Order for More Drinks Meals
                    </a>
                </div>
            </div>
            <!-- END OF FOOD TABLE -->

            <!-- MODAL PROFILE INFORMATION FOR CUSTOMER -->
            <div class="modal fade" id="profileModal">
                <div class="modal-dialog modal-lg" style="width: 90%">
                    <div class="modal-content text-center">
                        <div class="modal-header">
                            <h2 class="modal-title  font-weight-bold">
                                Profile Information for <?php echo $_SESSION["cus_name"]; ?>
                            </h2>
                            <button type="button" class="close" data-dismiss="modal"> <span> &times; </span> </button>
                        </div>
                        <div class="modal-body">
                            <div class="row ">
                                <div class="col-sm-8 justify-content-around text-center" style="margin: auto">
                                    <img src="../public/storage/customer_profileimage/<?php echo $img ?>" alt="" id="cusimg" />
                                </div>
                            </div>
                            <div class="row justify-content-around">
                                <div class="col-sm-4 my-info">
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-user-circle fa-1x"></i> Name : <?php echo $_SESSION["cus_name"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-envelope fa-1x"></i> Email : <?php echo $_SESSION["cus_email"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-user-shield fa-1x"></i> Role : <?php echo $_SESSION["cus_role"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-phone fa-1x"></i> Telephone : <?php echo $_SESSION["cus_telephone"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-heart fa-1x"></i> Relationship Status :
                                        <?php echo $_SESSION["cus_rel_status"]; ?>
                                    </p>
                                </div>
                                <div class="col-sm-4 my-info">
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-user fa-1x"></i> Gender : <?php echo $_SESSION["cus_gender"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-address-card fa-1x"></i> Address : <?php echo $_SESSION["cus_address"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-calendar-alt fa-1x"></i> Date of Birth : <?php echo $_SESSION["cus_dob"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-star fa-1x"></i> Role : <?php echo $_SESSION["cus_role"]; ?>
                                    </p>
                                    <p class="text-info font-weight-bold">
                                        <i class="fa fa-check-circle fa-1x"></i> Status : <?php echo $_SESSION["cus_status"]; ?>
                                    </p>
                                </div>
                            </div>
                            <a href="customers-update-profile.php" class="text-center btn btn-outline-info btn-md" id="update_button">
                                <i class="fa fa-user-edit fa-1x"></i> Update Profile
                            </a>
                        </div>
                        <div class="modal-footer">
                            <h3 class="text-left  font-weight-bold" style="font-family: monospace;">
                                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END OF CUSTOMER'S INFORMATION MODAL  -->


            <div class="footer">
                <h2 class="text-center">
                    <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                </h2>
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

    </div>
    <script>
        function showBreakfast() {
            document.getElementById("breakfast").style.display = "block";
            document.getElementById("lunch").style.display = "none";
            document.getElementById("dinner").style.display = "none";
            document.getElementById("drinks").style.display = "none";
        }

        function showLunch() {
            document.getElementById("breakfast").style.display = "none";
            document.getElementById("lunch").style.display = "block";
            document.getElementById("dinner").style.display = "none";
            document.getElementById("drinks").style.display = "none";
        }

        function showDinner() {
            document.getElementById("breakfast").style.display = "none";
            document.getElementById("lunch").style.display = "none";
            document.getElementById("dinner").style.display = "block";
            document.getElementById("drinks").style.display = "none";
        }

        function showDrinks() {
            document.getElementById("breakfast").style.display = "none";
            document.getElementById("lunch").style.display = "none";
            document.getElementById("dinner").style.display = "none";
            document.getElementById("drinks").style.display = "block";
        }
    </script>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/main.js"> </script>
</body>

</html>