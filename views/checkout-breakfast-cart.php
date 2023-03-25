<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (isset($_POST["checkout_submit"])) {
    $_SESSION["address"] = $_POST["address"];
}

$cus = new Customer();
$activeCus = $cus->checkActiveUserStatus($_SESSION["cus_id"]);

if ($activeCus === TRUE) {
    $user = new Customer;
    $userInfo = $user->selectOneCustomerInfo($_SESSION["cus_id"]);
} else {
    session_start();
    $_SESSION["inactive_user"] =
        '<div class="alert alert-danger alert-dismissible fade show" style="font-family: ubuntu mono; display: inline-block;">
        <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
        <h3 class="alert-heading"> Inactive User </h3>
        <p> You are not an active user <br /> Try updating your profile </p>
    </div>';
    header("location: food-breakfast-view.php");
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
        #receipt p {
            font-size: 14px;
        }

        #print_not_button,
        #print_button,
        #process_button {
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <div class="container">
        <?php
        if (isset($_SESSION["process_success"])) {
            if ($_SESSION["process_success"] == true) {

        ?>
                <div class="jumbotron shadow bg-white mt-5 mb-5" id="receipt_frame">
                    <h6 class='text-muted text-right'>
                        <?php $new_date = date("Y-m-d");
                        echo $new_date; ?>
                    </h6>
                    <h2 class="text-center align-content-center mb-3 font-weight-bold"> <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise </h2>
                    <div class="row justify-content-around" id="receipt">
                        <div class='col-sm-6'>
                            <div class="row">
                                <div class="col">
                                    <p class='font-weight-bold'> Name </p>
                                </div>
                                <div class='col'>
                                    <p class='font-weight-bold'>
                                        <span style="border-bottom: 1px solid dimgray; width: 100%; display: block;">
                                            <?php echo $userInfo["name"]; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class='font-weight-bold'> Address </p>
                                </div>
                                <div class='col'>
                                    <p class='font-weight-bold'>
                                        <span style="border-bottom: 1px solid dimgray; width: 100%; display: block;">
                                            <?php if ($_SESSION["address"] != "") {
                                                echo $_SESSION["address"];
                                            } else {
                                                echo $userInfo["address"];
                                            }
                                            ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class='font-weight-bold'> Email </p>
                                </div>
                                <div class='col'>
                                    <p class='font-weight-bold'>
                                        <span style="border-bottom: 1px solid dimgray; width: 100%; display: block;">
                                            <?php echo $userInfo["email"]; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <p class='font-weight-bold'> Telephone </p>
                                </div>
                                <div class='col'>
                                    <p class='font-weight-bold'>
                                        <span style="border-bottom: 1px solid dimgray; width: 100%; display: block;">
                                            <?php echo $userInfo["telephone"]; ?>
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-around mb-3 mt-3">
                        <div class="col-sm-6">
                            <table class="table-hover table-striped">
                                <thead>
                                    <tr class="text-center font-weight-bold">
                                        <th class="m-2 p-2" style="font-size: 18px;"> # </th>
                                        <th class="m-2 p-2" style="font-size: 18px;"> Name </th>
                                        <th class="m-2 p-2" style="font-size: 18px;"> Price </th>
                                        <th class="m-2 p-2" style="font-size: 18px;"> Quantity </th>
                                        <th class="m-2 p-2" style="font-size: 18px;"> Total Price </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $counter = 0;
                                    $total_price = 0;
                                    foreach ($_SESSION["userDetails"] as $details) {
                                        $total_price = $total_price + ((int)$details["foodPrice"] * (int)$details["cartQuantity"]);
                                        $counter = $counter + 1;
                                    ?>
                                        <tr>
                                            <td class="m-2 p-2 font-weight-bold">
                                                <p style="font-size: 15px;"> <?php echo $counter; ?> </p>
                                            </td>
                                            <td class="m-2 p-2">
                                                <p style="font-size: 15px;"> <?php echo $details["foodName"]; ?> </p>
                                            </td>
                                            <td class="m-2 p-2">
                                                <p style="font-size: 15px;"> <span> &#8358; </span> <?php echo $details["foodPrice"]; ?>
                                            </td>
                                            <td class="m-2 p-2">
                                                <p style="font-size: 15px;"> <?php echo $details["cartQuantity"]; ?> </p>
                                            </td>
                                            <td class="m-2 p-2">
                                                <p style="font-size: 15px;"> <span> &#8358; </span> <?php echo (int)$details["foodPrice"] * (int)$details["cartQuantity"]; ?> </p>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr class="bg-light border">
                                        <td class="m-2 p-2" style="font-size: 20px;" colspan="1"> </td>
                                        <td class="m-2 p-2" style="font-size: 20px;" colspan="1"> </td>
                                        <td class="m-2 p-2" style="font-size: 20px;" colspan="2"> Grand Total </td>
                                        <td class="m-2 p-2" style="font-size: 20px;"> <span> &#8358; </span> <?php echo $total_price; ?> </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row justify-content-between">
                        <div class="col-md-4">
                            <p class="text-muted text-center font-weight-bold mb-5"> Customer's Signature</p>
                            <p class="text-black text-center d-block w-100" style="border-bottom: 1px solid dimgray;"> </p>
                        </div>
                        <div class='col-md-4'>
                            <p class="text-muted text-center font-weight-bold"> Admin's Signature</p>
                            <p class="text-black text-center d-block w-100" style="border-bottom: 1px solid dimgray; font-size: 18px;">
                                <span style="font-family: embassy bt regular;"> SaucieEnterprise </span>
                            </p>
                        </div>
                    </div>
                </div>

        <?php
            }
        }
        ?>

        <div class="text-center bg-white shadow jumbotron mb-lg-5 mt-lg-5 mt-md-5 mb-md-5" id="print_button_frame">
            <a href="../controllers/clear-breakfast-cart.php" class="btn btn-outline-success btn-md" id="process_button" <?php if (isset($_SESSION["process_success"])) { ?> style="display: none;" <?php } ?>>
                <i class="fa fa-check-circle fa-1x"></i> <i class="fa fa-shopping-cart fa-1x"></i>
                Click to finish processing your order
            </a>

            <?php if (isset($_SESSION["process_success"])) {
                if ($_SESSION["process_success"] == true) {
            ?>
                    <a href="#" class="btn btn-outline-info btn-md m-2" id="print_button" onclick="return printReceipt()">
                        <i class="fa fa-print fa-1x"></i> Print Receipt
                    </a>

                    <a href="../controllers/finalize-breakfast-order.php" class="btn btn-outline-success btn-md m-2" id="print_not_button">
                        Don't Print Receipt
                    </a>

                    <a href="../controllers/finalize-breakfast-order.php" class="btn btn-outline-primary btn-md  m-2" id="print_not_button">
                        <i class="fa fa-home fa-1x"></i> Return to Customer's Homepage
                    </a>

            <?php
                }
            }
            ?>
        </div>


        <?php if (isset($_SESSION["process_success"])) {
            if ($_SESSION["process_success"] == true) {
        ?>
                <footer class="text-center mt-5 pt-5" id="page_footer">
                    <h3 class="text-dark"> <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise </h3>
                </footer>
        <?php
            }
        }
        ?>


    </div>
    <script>
        function printReceipt() {
            var frame = document.querySelector('#receipt_frame');
            frame.print();
        }
    </script>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/main.js"> </script>

</html>