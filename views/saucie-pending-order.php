<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

$order = new Order();

$pendingBreakfastOrderReferenceNumbers = $order->selectAllPendingOrderReferenceNumbersForAParticularTable("order_table_breakfast");
$pendingLunchOrderReferenceNumbers = $order->selectAllPendingOrderReferenceNumbersForAParticularTable("order_table_lunch");
$pendingDinnerOrderReferenceNumbers = $order->selectAllPendingOrderReferenceNumbersForAParticularTable("order_table_dinner");
$pendingDrinksOrderReferenceNumbers = $order->selectAllPendingOrderReferenceNumbersForAParticularTable("order_table_drinks");

if (($pendingBreakfastOrderReferenceNumbers == null) && ($pendingLunchOrderReferenceNumbers == null) && ($pendingDinnerOrderReferenceNumbers == null) && ($pendingDrinksOrderReferenceNumbers == null)) {
    $_SESSION['no_pending_order'] =
        '<div class="alert alert-info text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading">  No pending order! </h6>
            <p class=""> All your order has been delivered! </p>
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
                            Pending Breakfast Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#" class="nav-link" onclick="return showLunch();">
                            Pending Lunch Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#" class="nav-link" onclick="return showDinner();">
                            Pending Dinner Order
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-info text-center">
                        <a href="#" class="nav-link" onclick="return showDrinks();">
                            Pending Drinks Order
                        </a>
                    </li>
                    <?php if (isset($_SESSION["admin_name"])) { ?>
                        <li class="nav-item mt-4 mr-2 font-weight-bold text-info text-center">
                            <a href="#assign_order" class="nav-link">
                                Assign Order
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="text-center m-3">
            <?php

            if (isset($_SESSION['deliver_order'])) {
                echo $_SESSION['deliver_order'];
                unset($_SESSION['deliver_order']);
            }

            if (isset($_SESSION['assign_order_success'])) {
                echo $_SESSION['assign_order_success'];
                unset($_SESSION['assign_order_success']);
            }

            if (isset($_SESSION['assign_order_error'])) {
                echo $_SESSION['assign_order_error'];
                unset($_SESSION['assign_order_error']);
            }

            ?>
        </div>


        <?php if ($pendingBreakfastOrderReferenceNumbers != null) { ?>
            <div id="breakfast_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Pending Breakfast Order
                </h4>
                <?php foreach ($pendingBreakfastOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-deliver-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_breakfast" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($pendingLunchOrderReferenceNumbers != null) { ?>
            <div id="lunch_table" class="mt-5 mb-5 pb-5  container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Pending Lunch Order
                </h4>
                <?php foreach ($pendingLunchOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-deliver-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_lunch" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($pendingDinnerOrderReferenceNumbers != null) { ?>
            <div id="dinner_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Pending Dinner Order
                </h4>
                <?php foreach ($pendingDinnerOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-deliver-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_dinner" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if ($pendingDrinksOrderReferenceNumbers != null) { ?>
            <div id="drinks_table" class="mt-5 mb-5 pb-5 container jumbotron text-center bg-white shadow">
                <h4 class="text-info font-weight-bold m-3">
                    All Reference Number(s) for Pending Drinks Order
                </h4>
                <?php foreach ($pendingDrinksOrderReferenceNumbers as $refno) { ?>
                    <form action="saucie-deliver-order.php" method="POST" class="d-inline">
                        <input type="hidden" name="order_table" value="order_table_drinks" />
                        <input type="hidden" name="refNo" value="<?php echo $refno['ref']; ?>" />
                        <button type="submit" class="btn btn-outline-info btn-md m-1" name="submit_button">
                            <?php echo $refno['ref'] ?>
                        </button>
                    </form>
                <?php } ?>
            </div>
        <?php } ?>


        <?php if (isset($_SESSION["admin_name"])) { ?>
            <div class="row justify-content-around" id="assign_order">
                <div class="col-md-4">
                    <div class="text-center jumbotron ml-4 mr-4 mt-4 mb-4 shadow-lg bg-light" style="display: inline-block; color: black">
                        <h5 class="text-center text-info"> Assign Order </h5>
                        <form class=" text-center" method="POST" action="../controllers/admin-assign-order.php">
                            <input type="hidden" name="admin_id" value="<?php echo $_SESSION["admin_id"]; ?>">
                            <div class="row justify-content-around">
                                <div class='col-sm-5 m-2'>
                                    <div class="form-group">
                                        <label> Order Ref No </label>
                                        <input class="form-control w-20 text-dark" type="text" placeholder="Input Order Ref No" name="ref_no" required>
                                    </div>
                                </div>
                                <div class='col-sm-5 m-2'>
                                    <div class="form-group">
                                        <label> Staff ID </label>
                                        <input class="form-control text-dark" type="text" placeholder="Input Staff ID" name="staff_id" required>
                                    </div>
                                </div>
                            </div>
                            <div class="m-auto">
                                <input type="submit" name="assign_order" class="btn btn-info btn-md" value="Assign Order">
                            </div>
                        </form>
                    </div>
                </div>
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