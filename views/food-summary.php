<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
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
        #sumaryFrame {
            border: 3px solid antiquewhite;
        }
    </style>
</head>

<body class=" bg-white">
    <div class="container">

        <?php
        $breakfast = new Food();
        $breakfastSummary = $breakfast->selectAllBreakfastMeals();

        $breakfast_items = 0;
        $breakfast_total_quantity = 0;

        foreach ($breakfastSummary as $row) {
            $breakfast_items = $breakfast_items + 1;
            // $breakfast_total_quantity = $breakfast_total_quantity + $row["quantity"];
        }
        ?>

        <?php
        $lunch = new Food();
        $lunchSummary = $lunch->selectAllLunchMeals();

        $lunch_items = 0;
        $lunch_total_quantity = 0;

        foreach ($lunchSummary as $row) {
            $lunch_items = $lunch_items + 1;
            // $lunch_total_quantity = $lunch_total_quantity + $row["quantity"];
        }
        ?>

        <?php
        $dinner = new Food();
        $dinnerSummary = $dinner->selectAllDinnerMeals();

        $dinner_items = 0;
        $dinner_total_quantity = 0;

        foreach ($dinnerSummary as $row) {
            $dinner_items = $dinner_items + 1;
            // $dinner_total_quantity = $dinner_total_quantity + $row["quantity"];
        }
        ?>

        <?php
        $drinks = new Food();
        $drinksSummary = $drinks->selectAllDrinksMeals();

        $drinks_items = 0;
        $drinks_total_quantity = 0;

        foreach ($drinksSummary as $row) {
            $drinks_items = $drinks_items + 1;
            // $drinks_total_quantity = $drinks_total_quantity + $row["quantity"];
        }
        ?>

        <header class="text-center m-3 p-2">
            <h2> <i class="fa fa-cookie-bite fa-1x"></i> Saucie </h2>
        </header>
        <h3 class="text-center">
            Saucie Restuarant Food Information Summary
        </h3>
        <div class="row mt-4 mb-4 justify-content-between">
            <div class="col-sm-5 shadow-lg bg-white" id="summaryFrame">
                <h4 class="text-left"> Breakfast Food Summary </h4>
                <h5 class="text-left"> Food-Name : Food-Quantity </h5>
                <?php
                foreach ($breakfastSummary as $summary) { ?>
                    <p class="text-dark" style=" font-size: 15px;">
                        <span style=" font-weight: bold;">
                            <?php echo $summary["name"] ?> :
                        </span>
                        <?php echo $summary["quantity"]; ?>
                    </p>
                <?php } ?>
                <h6 class="text-center" style="color: black"> Total Items :
                    <span class="font-weight-bold"> <?php echo $breakfast_items; ?> </span>
                </h6>
                <h6 class="text-center" style="color: black">
                    Total Items Quantity :
                    <span class="font-weight-bold"> <?php echo $breakfast_total_quantity; ?> </span>
                </h6>
            </div>

            <div class="col-sm-5 shadow-lg bg-white" id="summaryFrame">
                <h4 class="text-left"> Lunch Food Summary </h4>
                <h5 class="text-left"> Food-Name : Food-Quantity </h5>
                <?php
                foreach ($lunchSummary as $summary) { ?>
                    <p class="text-dark" style=" font-size: 15px;">
                        <span style="font-weight: bold;">
                            <?php echo $summary["name"] ?> :
                        </span>
                        <?php echo $summary["quantity"]; ?>
                    </p>
                <?php } ?>
                <h6 class="text-center" style="color: black"> Total Items :
                    <span class="font-weight-bold"> <?php echo $lunch_items; ?> </span>
                </h6>
                <h6 class="text-center" style=" color: black">
                    Total Items Quantity :
                    <span class="font-weight-bold"> <?php echo $lunch_total_quantity; ?> </span>
                </h6>
            </div>
        </div>

        <div class="row mt-4 mb-4 justify-content-between">
            <div class="col-sm-5 shadow-lg bg-white" id="summaryFrame">
                <h4 class="text-left"> Dinner Food Summary </h4>
                <h5 class="text-left"> Food-Name : Food-Quantity </h5>
                <?php
                foreach ($dinnerSummary as $summary) { ?>
                    <p class="text-dark" style="font-size: 15px;">
                        <span style="font-weight: bold;">
                            <?php echo $summary["name"] ?> :
                        </span>
                        <?php echo $summary["quantity"]; ?>
                    </p>
                <?php } ?>
                <h6 class="text-center" style="color: black"> Total Items :
                    <span class="font-weight-bold"> <?php echo $dinner_items; ?> </span>
                </h6>
                <h6 class="text-center" style="color: black">
                    Total Items Quantity :
                    <span class="font-weight-bold"> <?php echo $dinner_total_quantity; ?> </span>
                </h6>
            </div>

            <div class="col-sm-5  shadow-lg bg-white" id="summaryFrame">
                <h4 class="text-left"> Drinks Food Summary </h4>
                <h5 class="text-left"> Food-Name : Food-Quantity </h5>
                <?php
                foreach ($drinksSummary as $summary) { ?>
                    <p class="text-dark" style=" font-size: 15px;">
                        <span style="font-weight: bold;">
                            <?php echo $summary["name"] ?> :
                        </span>
                        <?php echo $summary["quantity"]; ?>
                    </p>
                <?php } ?>
                <h6 class="text-center" style="color: black"> Total Items :
                    <span class="font-weight-bold"> <?php echo $drinks_items; ?> </span>
                </h6>
                <h6 class="text-center" style="color: black">
                    Total Items Quantity :
                    <span class="font-weight-bold"> <?php echo $drinks_total_quantity; ?> </span>
                </h6>
            </div>
        </div>


        <?php if (isset($_SESSION["admin_id"])) { ?>
            <div class="text-center mt-5 mb-5">
                <a href="admin-homepage.php" class="btn btn-info btn-md rounded">
                    <i class="fa fa-home fa-1x"></i> Admin Homepage
                </a>
            </div>
        <?php } ?>

        <?php if (isset($_SESSION["staff_id"])) { ?>
            <div class="text-center mt-5 mb-5">
                <a href="staff-homepage.php" class="btn btn-info btn-md rounded">
                    <i class="fa fa-home fa-1x"></i> Staff Homepage
                </a>
            </div>
        <?php } ?>



        <footer>
            <h3 class="text-center">
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