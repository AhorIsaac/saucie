<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!$_SESSION['cus_name']) {
    header("location: customers-sign-in.php");
}

$user_id = $_SESSION["cus_id"];

$order = new Order();

$deliveredBreakfastOrder = $order->selectAllDeliveredBreakfastOrderForOneCustomer($_SESSION["cus_id"]);
$deliveredLunchOrder = $order->selectAllDeliveredLunchOrderForOneCustomer($_SESSION["cus_id"]);
$deliveredDinnerOrder = $order->selectAllDeliveredDinnerOrderForOneCustomer($_SESSION["cus_id"]);
$deliveredDrinksOrder = $order->selectAllDeliveredDrinksOrderForOneCustomer($_SESSION["cus_id"]);

if (($deliveredBreakfastOrder == null) && ($deliveredLunchOrder == null) && ($deliveredDinnerOrder == null) && ($deliveredDrinksOrder == null)) {
    $_SESSION['no_delivered_order'] =
        '<div class="alert alert-info text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading">  No delivered order! </h6>
            <p class=""> All your order has been delivered! </p>
        </div>';
    header("location: customers-homepage.php");
    exit();
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
    <link href="../public/css/main-style.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #pimg {
            width: 50px;
            height: 50px;
            border-radius: 25px;
        }

        #food_img {
            width: 200px;
            height: 100px;
            border-radius: 8px;

        }

        table h4 {
            font-family: monospace;
        }

        .nav-link:hover {
            color: black;
            background-color: orange;
        }

        td {
            font-weight: bold;
        }
    </style>
</head>

<body onload="return showBreakfast();">
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <a href="#" class="navbar-brand">
                <h3> <i class="fa fa-cookie-bite fa-2x"></i> Saucie </h3>
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mt-4 mr-3 font-weight-bold text-center">
                        <a href="customers-homepage.php" class="nav-link">
                            <i class="fa fa-home fa-1x"></i> Customer's Homepage
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#" class="nav-link" onclick="return showBreakfast();">
                            Delivered Breakfast Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#" class="nav-link" onclick="return showLunch();">
                            Delivered Lunch Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#" class="nav-link" onclick="return showDinner();">
                            Delivered Dinner Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-info text-center">
                        <a href="#" class="nav-link" onclick="return showDrinks();">
                            Delivered Drinks Order
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a href="#" class="nav-link text-center">
                            <img src="../public/storage/customer_profileimage/<?php echo $_SESSION["cus_profileimage"]; ?>" alt="" id="pimg" class="text-center" />
                            <span class="sr-only">(current)</span>
                        </a>
                        <h6 class="text-center font-weight-bold"> <?php echo $_SESSION["cus_name"]; ?> </h6>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="text-center m-3 p-3 bg-light">
            <h5 class="text-dark">
                Here is a <i class="fa fa-list-alt fa-1x"></i> of your delivered order <i class="fa fa-shopping-cart fa-1x"></i>
            </h5>
        </div>

        <div id="breakfast_table">
            <?php if ($deliveredBreakfastOrder != null) { ?>
                <div id="breakfast_table" class="mt-5 mb-5">
                    <h4 class="font-weight-bold text-center"> Delivered Breakfast Order </h4>
                    <table class="table-hover table-striped shadow-lg bordered-lg m-auto">
                        <thead style="color: black;">
                            <tr>
                                <th class="text-center m-3 p-2"> Ref No </th>
                                <th class="text-center m-3 p-2"> Food Name </th>
                                <th class="text-center m-3 p-2"> <i class="fa fa-image fa-1x"></i> </th>
                                <th class="text-center m-3 p-2"> Quantity Requested </th>
                                <th class="text-center m-3 p-2"> Price </th>
                                <th class="text-center m-3 p-2"> Total Price </th>
                                <th class="text-center m-3 p-2"> <i class="fa fa-calendar-alt fa-1x"></i>
                                    <i class="fa fa-clock fa-1x"></i> Time-Date
                                </th>
                                <th class="text-center m-3 p-2"> Delivered </th>
                            </tr>
                        </thead>
                        <tbody style="color: black;">
                            <?php
                            $total_price_breakfast = 0;

                            foreach ($deliveredBreakfastOrder as $delivered) {
                                $total_price_breakfast = $total_price_breakfast + $delivered["order_total_price"];
                            ?>
                                <tr>
                                    <td class="text-center p-2"> <?php echo $delivered["order_reference_number"]; ?> </td>
                                    <td class="text-center p-2"> <?php echo $delivered["order_food_name"]; ?> </td>
                                    <td class="text-center p-2">
                                        <img src="../public/storage/uploaded_food/<?php echo $delivered["order_food_image"]; ?>" id="food_img" />
                                    </td>
                                    <td class="text-center p-2"> <?php echo $delivered["order_quantity"]; ?> </td>
                                    <td class="text-center p-2"> <?php echo $delivered["order_price"]; ?> </td>
                                    <td class="text-center p-2"> <?php echo $delivered["order_total_price"]; ?> </td>
                                    <td class="text-center p-2"> <?php echo $delivered["order_reference_time"]; ?> </td>
                                    <td class="text-center p-2">
                                        <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot style="color: black;">
                            <tr>
                                <td class="text-center p-2" colspan="4"></td>
                                <td class="text-center p-2 font-weight-bold"> Total </td>
                                <td class="text-center p-2 font-weight-bold" colspan="1"> <span> &#8358; </span> <?php echo $total_price_breakfast ?> </td>
                            </tr>
                        </tfoot>
                    </table>
                </div> 
            <?php } ?>
        </div>



        <?php if ($deliveredLunchOrder != null) { ?>
            <div id="lunch_table" class="mt-5 mb-5">
                <h4 class="font-weight-bold text-center"> Delivered Lunch Order </h4>
                <table class="table-hover table-striped shadow-lg bordered-lg m-auto">
                    <thead style="color: black;">
                        <tr>
                            <th class="text-center m-3 p-2"> Ref No </th>
                            <th class="text-center m-3 p-2"> Food Name </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-image fa-1x"></i> </th>
                            <th class="text-center m-3 p-2"> Quantity Requested </th>
                            <th class="text-center m-3 p-2"> Price </th>
                            <th class="text-center m-3 p-2"> Total Price </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-calendar-alt fa-1x"></i>
                                <i class="fa fa-clock fa-1x"></i> Time-Date
                            </th>
                            <th class="text-center m-3 p-2"> Delivered </th>
                        </tr>
                    </thead>
                    <tbody style="color: black;">
                        <?php
                        $total_price_lunch = 0;

                        foreach ($deliveredLunchOrder as $delivered) {
                            $total_price_lunch = $total_price_lunch + $delivered["order_total_price"];
                        ?>
                            <tr>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_number"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_food_name"]; ?> </td>
                                <td class="text-center p-2">
                                    <img src="../public/storage/uploaded_food/<?php echo $delivered["order_food_image"]; ?>" id="food_img" />
                                </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_quantity"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_total_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_time"]; ?> </td>
                                <td class="text-center p-2">
                                    <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot style="color: black;">
                        <tr>
                            <td class="text-center p-2" colspan="4"></td>
                            <td class="text-center p-2 font-weight-bold"> Total </td>
                            <td class="text-center p-2 font-weight-bold" colspan="1"> <span> &#8358; </span> <?php echo $total_price_lunch ?> </td>
                        </tr>
                    </tfoot>
                </table>
            </div> <?php } ?>


        <?php if ($deliveredDinnerOrder != null) { ?>
            <div id="dinner_table" class="mt-5 mb-5">
                <h4 class="font-weight-bold text-center"> Delivered Dinner Order </h4>
                <table class="table-hover table-striped shadow-lg bordered-lg m-auto">
                    <thead style="color: black;">
                        <tr>
                            <th class="text-center m-3 p-2"> Ref No </th>
                            <th class="text-center m-3 p-2"> Food Name </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-image fa-1x"></i> </th>
                            <th class="text-center m-3 p-2"> Quantity Requested </th>
                            <th class="text-center m-3 p-2"> Price </th>
                            <th class="text-center m-3 p-2"> Total Price </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-calendar-alt fa-1x"></i>
                                <i class="fa fa-clock fa-1x"></i> Time-Date
                            </th>
                            <th class="text-center m-3 p-2"> Delivered </th>
                        </tr>
                    </thead>
                    <tbody style="color: black;">
                        <?php
                        $total_price_dinner = 0;

                        foreach ($deliveredDinnerOrder as $delivered) {
                            $total_price_dinner = $total_price_dinner + $delivered["order_total_price"];
                        ?>
                            <tr>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_number"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_food_name"]; ?> </td>
                                <td class="text-center p-2">
                                    <img src="../public/storage/uploaded_food/<?php echo $delivered["order_food_image"]; ?>" id="food_img" />
                                </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_quantity"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_total_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_time"]; ?> </td>
                                <td class="text-center p-2">
                                    <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot style="color: black;">
                        <tr>
                            <td class="text-center p-2" colspan="4"></td>
                            <td class="text-center p-2 font-weight-bold"> Total </td>
                            <td class="text-center p-2 font-weight-bold" colspan="1"> <span> &#8358; </span> <?php echo $total_price_dinner ?> </td>
                        </tr>
                    </tfoot>
                </table>
            </div> <?php } ?>


        <?php if ($deliveredDrinksOrder != null) { ?>
            <div id="drinks_table" class="mt-5 mb-5">
                <h4 class="font-weight-bold text-center"> Delivered Drinks Order </h4>
                <table class="table-hover table-striped shadow-lg bordered-lg m-auto">
                    <thead style="color: black;">
                        <tr>
                            <th class="text-center m-3 p-2"> Ref No </th>
                            <th class="text-center m-3 p-2"> Food Name </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-image fa-1x"></i> </th>
                            <th class="text-center m-3 p-2"> Quantity Requested </th>
                            <th class="text-center m-3 p-2"> Price </th>
                            <th class="text-center m-3 p-2"> Total Price </th>
                            <th class="text-center m-3 p-2"> <i class="fa fa-calendar-alt fa-1x"></i>
                                <i class="fa fa-clock fa-1x"></i> Time-Date
                            </th>
                            <th class="text-center m-3 p-2"> Delivered </th>
                        </tr>
                    </thead>
                    <tbody style="color: black;">
                        <?php
                        $total_price_drinks = 0;

                        foreach ($deliveredDrinksOrder as $delivered) {
                            $total_price_drinks = $total_price_drinks + $delivered["order_total_price"];
                        ?>
                            <tr>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_number"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_food_name"]; ?> </td>
                                <td class="text-center p-2">
                                    <img src="../public/storage/uploaded_food/<?php echo $delivered["order_food_image"]; ?>" id="food_img" />
                                </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_quantity"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_total_price"]; ?> </td>
                                <td class="text-center p-2"> <?php echo $delivered["order_reference_time"]; ?> </td>
                                <td class="text-center p-2">
                                    <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot style="color: black;">
                        <tr>
                            <td class="text-center p-2" colspan="4"></td>
                            <td class="text-center p-2 font-weight-bold"> Total </td>
                            <td class="text-center p-2 font-weight-bold" colspan="1"> <span> &#8358; </span> <?php echo $total_price_drinks ?> </td>
                        </tr>
                    </tfoot>
                </table>
            </div> <?php } ?>



        <footer class="text-center m-3 p-3">
            <h2 class="text-center" style="color: black">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h2>
        </footer>
    </div>
    <script>
        function showBreakfast() {
            document.getElementById("breakfast_table").style.display = "block";
            document.getElementById("lunch_table").style.display = "none";
            document.getElementById("dinner_table").style.display = "none";
            document.getElementById("drinks_table").style.display = "none";
        }

        function showLunch() {
            document.getElementById("breakfast_table").style.display = "none";
            document.getElementById("lunch_table").style.display = "block";
            document.getElementById("dinner_table").style.display = "none";
            document.getElementById("drinks_table").style.display = "none";
        }

        function showDinner() {
            document.getElementById("breakfast_table").style.display = "none";
            document.getElementById("lunch_table").style.display = "none";
            document.getElementById("dinner_table").style.display = "block";
            document.getElementById("drinks_table").style.display = "none";
        }

        function showDrinks() {
            document.getElementById("breakfast_table").style.display = "none";
            document.getElementById("lunch_table").style.display = "none";
            document.getElementById("dinner_table").style.display = "none";
            document.getElementById("drinks_table").style.display = "block";
        }
    </script>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/main.js"> </script>
</body>

</html>