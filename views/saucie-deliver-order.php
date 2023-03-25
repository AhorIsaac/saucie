<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (isset($_POST["submit_button"])) {
    $reference_number = $_POST["refNo"];
    $order_table = $_POST["order_table"];

    $_SESSION["order_table_name"] = $order_table;

    $order = new Order();
    $orderInfo = $order->selectParticularOrderBasedOnReferenceNumber($reference_number, $order_table);
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

        #cus_img {
            width: 250px;
            height: 200px;
            border-radius: 50px;
            border: 1px solid orange;

        }

        #food_img {
            width: 150px;
            height: 75px;
            border-radius: 8px;
            border: 1px solid orange;
        }

        #ord_btn {
            border-radius: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container-fluid">
        <h1 class="text-dark font-weight-bold text-center mt-3 mb-3">
            <i class='fa fa-cookie-bite fa-1x'></i> Saucie
        </h1>

        <h3 class="course-heading text-info text-center m-2" style="font-family: monospace;">
            Order Information Page
        </h3>

        <div class='jumbotron bg-white shadow mt-md-4 mt-lg-4'>
            <h6 class="course-heading text-right text-dark" style="font-family: monospace;">
                Order Reference <i class="fa fa-clock fa-1x"></i> :
                <?php
                foreach ($orderInfo as $info) {
                    echo $info["order_reference_time"];
                    break;
                }
                ?>
            </h6>
            <div class="row justify-content-center text-center">
                <div class="col-md-6 col-lg-6">
                    <?php
                    foreach ($orderInfo as $info) {
                    ?>
                        <img src="../public/storage/customer_profileimage/<?php echo $info["order_user_image"]; ?>" id="cus_img" class="shadow mb-2" />
                    <?php
                        break;
                    }
                    ?>
                    <table class='table table-hover table-striped mt-2'>
                        <?php
                        foreach ($orderInfo as $info) {
                        ?>

                            <div class="row m-1">
                                <div class="col">
                                    <h6 class="text-dark font-weight-bold"> Name </h6>
                                </div>
                                <div class="col">
                                    <p class="text-info" style="font-size: 16px;">
                                        <?php echo $info["order_username"]; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row m-1">
                                <div class="col">
                                    <h6 class="text-dark font-weight-bold"> Email </h6>
                                </div>
                                <div class="col">
                                    <p class="text-info" style="font-size: 16px;">
                                        <?php echo $info["order_email"]; ?>
                                    </p>
                                </div>
                            </div>

                            <div class="row m-1">
                                <div class="col">
                                    <h6 class="text-dark font-weight-bold"> Delivery Address </h6>
                                </div>
                                <div class="col">
                                    <?php if ($info["address"] == null) {
                                    ?>
                                        <p class="text-info" style="font-size: 16px;">
                                            <?php echo $info["customer_address"]; ?>
                                        </p>
                                    <?php
                                    } else {
                                    ?>
                                        <p class="text-info" style="font-size: 16px;">
                                            <?php echo $info["address"]; ?>
                                        </p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="row m-1">
                                <div class="col">
                                    <h6 class="text-dark font-weight-bold"> Telephone </h6>
                                </div>
                                <div class="col">
                                    <p class="text-info" style="font-size: 16px;">
                                        <?php echo $info["order_telephone"]; ?>
                                    </p>
                                </div>
                            </div>
                        <?php
                            break;
                        }
                        ?>
                    </table>
                </div>
                <div class="col-md-6 col-lg-6">
                    <table class="table table-hover table-striped text-center">
                        <thead>
                            <tr>
                                <th> # </th>
                                <th> Name </th>
                                <th> <i class="fa fa-image fa-1x"></i> </th>
                                <th> Quantiy </th>
                                <th> Price </th>
                                <th> Total Price </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $grand_total_price = 0;
                            $i = 1;
                            foreach ($orderInfo as $info) {
                                $grand_total_price = $grand_total_price + $info["order_total_price"];
                            ?>

                                <tr>
                                    <td>
                                        <p class="text-info"> <?php echo $i; ?> </p>
                                    </td>
                                    <td>
                                        <p class="text-info"> <?php echo $info["order_food_name"]; ?> </p>
                                    </td>
                                    <td>
                                        <img src="../public/storage/uploaded_food/<?php echo $info["order_food_image"] ?>" id="food_img" />
                                    </td>
                                    <td>
                                        <p class="text-info">
                                            <?php echo $info["order_quantity"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-info">
                                            <span>&#8358;</span><?php echo $info["order_price"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-info">
                                            <span>&#8358;</span><?php echo $info["order_total_price"]; ?>
                                        </p>
                                    </td>
                                </tr>

                            <?php
                                $i = $i + 1;
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="text-right text-info font-weight-bold">
                                    <?php

                                    foreach ($orderInfo as $info) {
                                    ?>
                                        <p class="text-info font-weight-bold">
                                            Order Reference Number: <?php echo $info["order_reference_number"] ?>
                                        </p>
                                    <?php
                                        break;
                                    }
                                    ?>
                                </td>
                                <td colspan="2" class="text-right text-warning font-weight-bold">
                                    Grand Total Price
                                </td>
                                <td>
                                    <p class="text-success font-weight-bold">
                                        <span>&#8358;</span><?php echo $grand_total_price; ?>
                                    </p>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            <div class="text-center m-2">
                <a href="saucie-pending-order.php" class="btn btn-outline-info m-2" id="ord_btn">
                    Return to Pending Order Homepage
                </a>
                <?php
                if (isset($_SESSION["staff_id"])) {
                    foreach ($orderInfo as $info) {
                ?>
                        <a href="../controllers/saucie-deliver-this-particular-order.php?ref_no=<?php echo $info["order_reference_number"] ?>" class="btn btn-outline-success m-2" id="ord_btn" onclick="return confirm('Do you wish to deliver this order?')">
                            <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                            Deliver this Order
                        </a>
                <?php
                        break;
                    }
                }
                ?>
            </div>
        </div>

        <footer class="text-center m-3 p-3">
            <h3 class="text-center" style="color: black">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>

    <script src="../public/js/main.js"> </script>
</body>

</html>