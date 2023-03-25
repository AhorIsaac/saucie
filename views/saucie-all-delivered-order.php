<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!(isset($_SESSION["admin_id"]) || (isset($_SESSION["staff_id"])))) {
    header('location: users-login.php');
}

$order = new Order();

$deliveredBreakfastOrderReferenceNumbers = $order->selectAllDeliveredOrderReferenceNumbersForAParticularTable("order_table_breakfast");

$deliveredLunchOrderReferenceNumbers = $order->selectAllDeliveredOrderReferenceNumbersForAParticularTable("order_table_lunch");

$deliveredDinnerOrderReferenceNumbers = $order->selectAllDeliveredOrderReferenceNumbersForAParticularTable("order_table_dinner");

$deliveredDrinksOrderReferenceNumbers = $order->selectAllDeliveredOrderReferenceNumbersForAParticularTable("order_table_drinks");

if (($deliveredBreakfastOrderReferenceNumbers == null) && ($deliveredLunchOrderReferenceNumbers == null) && ($deliveredDinnerOrderReferenceNumbers == null) && ($deliveredDrinksOrderReferenceNumbers == null)) {
    $_SESSION['no_delivered_order'] =
        '<div class="alert alert-info text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading">  No delivered order! </h6>
            <p class=""> All order are pending! </p>
        </div>';
    header("location: staff-homepage.php");
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
            border: 1px solid orange;
            font-family: monospace;
        }

        .nav-link:hover {
            color: black;
            background-color: orange;
        }

        input[type="text"] {
            border: 1px solid orange;
            color: black;
        }

        #user_img {
            width: 100px;
            height: 100px;
            border-radius: 100px;
            border: 1px dotted orange;
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
                    <?php if (isset($_SESSION["admin_id"])) { ?>
                        <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                            <a href="admin-homepage.php" class="nav-link">
                                <i class="fa fa-home fa-1x"></i> Admin Homepage
                            </a>
                        </li>
                    <?php } ?>

                    <?php if (isset($_SESSION["staff_id"])) { ?>
                        <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                            <a href="staff-homepage.php" class="nav-link">
                                <i class="fa fa-home fa-1x"></i> Staff Homepage
                            </a>
                        </li>
                    <?php } ?>

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
                </ul>
            </div>
        </nav>


        <?php if ($deliveredBreakfastOrderReferenceNumbers != null) { ?>
            <div id="breakfast_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Delivered Breakfast Order
                </h4>
                <?php foreach ($deliveredBreakfastOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-delivered-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_breakfast" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($deliveredLunchOrderReferenceNumbers != null) { ?>
            <div id="lunch_table" class="mt-5 mb-5 pb-5  container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Delivered Lunch Order
                </h4>
                <?php foreach ($deliveredLunchOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-delivered-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_lunch" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($deliveredDinnerOrderReferenceNumbers != null) { ?>
            <div id="dinner_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Delivered Dinner Order
                </h4>
                <?php foreach ($deliveredDinnerOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-delivered-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_dinner" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($deliveredDrinksOrderReferenceNumbers != null) { ?>
            <div id="drinks_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Delivered Drinks Order
                </h4>
                <?php foreach ($deliveredDrinksOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-delivered-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_drinks" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>

    <script src="../public/js/main.js"> </script>

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

</body>

</html>