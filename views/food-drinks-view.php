<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}


if (!$_SESSION["cus_name"]) {
    header("location: users-login.php");
}

if (isset($_SESSION["cus_id"])) {
    $user_id = $_SESSION["cus_id"];

    $customer = new Food();
    $userDetails = $customer->drinksCartUserDetails($user_id);

    $_SESSION["userDetails"] = $userDetails;

    if ($userDetails == 0) {
        session_start();
        $_SESSION["empty_drinks_cart"] =
            '<div class="alert alert-info alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
            <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h3 class="alert-heading"> Empty <i class="fa fa-cart-plus fa-1x"></i> </h3>
            <p> Your cart is empty </p>
        </div>';
        header("location: food-drinks.php");
        exit();
    }

    $total_price = 0;
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
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/css/staff-style.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: Arial;
            background-attachment: fixed;
            background-size: cover;
            background: white;
        }

        #food_img {
            width: 200px;
            height: 100px;
            border-radius: 8px;

        }

        #breakfast {
            border: 1px solid dimgray;
            border-radius: 10px;
            background: linear-gradient(90deg,
                    rgba(128, 128, 128, 0.1)25%,
                    rgba(128, 128, 128, 0.1)50%,
                    rgba(128, 128, 128, 0.1)70%,
                    rgba(128, 128, 128, 0.1)100%);
            font-family: Arial;
            box-shadow: 0 0 3px 1px dimgray;
        }

        #breakfast_frame {
            margin-left: 4px;
            margin-right: 4px;
            padding-bottom: 4px;
            padding-top: 8px;
            border: 1px solid dimgray;
            border-radius: 10px;
            background: linear-gradient(90deg,
                    rgba(128, 128, 128, 0.1)25%,
                    rgba(128, 128, 128, 0.1)50%,
                    rgba(128, 128, 128, 0.1)70%,
                    rgba(128, 128, 128, 0.1)100%);
            font-family: Arial;
            box-shadow: 0 0 3px 1px dimgray;
        }

        #breakfast_frame p,
        #breakfast_frame label {
            color: black;
        }

        #breakfast_frame input[type="number"] {
            width: 80px;
            color: black;
            font-weight: bold;
        }

        @media screen and (max-device-width: 480px) {
            #breakfast_frame {
                width: 100%;
            }
        }

        #pimg {
            width: 50px;
            height: 50px;
            border-radius: 25px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- ***** ***** -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <a href="#" class="navbar-brand">
                <h3> <i class="fa fa-cookie-bite fa-2x"></i> Saucie </h3>
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a href="#" class="nav-link text-center">
                            <img src="../public/storage/customer_profileimage/<?php echo $_SESSION["cus_profileimage"]; ?>" alt="" id="pimg" class="text-center" />
                            <span class="sr-only">(current)</span>
                        </a>
                        <h6 class="text-center font-weight-bold"> <?php echo $_SESSION["cus_name"]; ?> </h6>
                    </li>
                    <li class="nav-item text-center">
                        <a class="nav-link" href="#">
                            <i class="fa fa-shopping-cart fa-2x"></i>
                            <span class="badge badge-success" style="font-size: 15px">
                                <?php $cartRow = new Food();
                                $cartNum = $cartRow->rowCountDrinksCart($_SESSION["cus_id"]); ?>
                                <?php if (isset($cartNum)) {
                                    echo $cartNum;
                                } else {
                                    echo 0;
                                } ?>
                            </span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <div class="text-center">
            <?php
            if (isset($_SESSION["inactive_user"])) {
                echo $_SESSION["inactive_user"];
                unset($_SESSION["inactive_user"]);
            }

            if (isset($_SESSION["delete_drinks_success"])) {
                echo $_SESSION["delete_drinks_success"];
                unset($_SESSION["delete_drinks_success"]);
            }
            ?>
        </div>

        <!-- ALL ABOUT DINNER FRAME -->
        <form action="checkout-drinks-cart.php" method="POST">
            <div class="mb-4">

                <div class="text-center form-group row mt-3 mb-4">
                    <label for="inputAddresss" class="col-form-label col-md-4 text-right" style="font-size: 18px;">
                        <i class="fa fa-address-card fa-1x"></i> Delivery Address
                    </label>
                    <div class="col-md-5">
                        <input type="text" name="address" class="form-control">
                    </div>
                </div>

                <div class="col-md-10 mb-4 text-center" style="margin: auto">
                    <h3 class="text-center" style="font-family: arial;">
                        List of items you added to your <i class="fa fa-shopping-cart fa-1x"></i>
                    </h3>

                    <table class="table-hover table-striped table-bordered shadow-lg">
                        <thead class="text-center">
                            <tr>
                                <th class="p-3 m-2"> Code </th>
                                <th class="p-3 m-2"> Image </th>
                                <th class="p-3 m-2"> Name </th>
                                <th class="p-3 m-2"> Price Tag </th>
                                <th class="p-3 m-2"> Quantity Requested </th>
                                <th class="p-3 m-2"> Total Price </th>
                                <th class="p-3 m-2">
                                    <a href="../controllers/delete-all-from-drinks-cart.php" class="btn btn-danger btn-md" onclick="return confirm('Do you want to clear your cart?'); ">
                                        <i class="fa fa-trash alt"></i> Clear Cart
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            <?php foreach ($userDetails as $details) {
                                $total_price = $total_price + ((int)$details["foodPrice"] * (int)$details["cartQuantity"]);

                            ?>
                                <tr>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <?php echo $details["foodId"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <img class="card-img-top" src="../public/storage/uploaded_food/<?php echo $details["foodImage"]; ?>" alt="" id="food_img" />
                                    </td>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <?php echo $details["foodName"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <span> &#8358; </span><?php echo $details["foodPrice"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <?php echo $details["cartQuantity"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <span> &#8358; </span> <?php echo (int)$details["foodPrice"] * (int)$details["cartQuantity"]; ?>
                                        </p>
                                    </td>
                                    <td>
                                        <p class="" style="font-size: 18px;">
                                            <a href="../controllers/delete-from-drinks-cart.php?food_id=<?php echo $details["foodId"]; ?>" class="btn btn-outline-danger btn-sm text-center" onclick="return confirm('Are you sure you want to remove this item?'); ">
                                                <i class="fa fa-trash-alt fa-1x"></i>
                                            </a>
                                        </p>
                                    </td>
                                </tr>
                            <?php  } ?>
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <td colspan="2">
                                    <a href="food-drinks.php" class="btn btn-outline-success">
                                        <i class="fa fa-cart-plus fa-1x"></i> Continue Shopping
                                    </a>
                                </td>
                                <td colspan="3">
                                    <p class="font-weight-bold"> Grand Total Price </p>
                                </td>
                                <td colspan="">
                                    <p class="font-weight-bold"> <span> &#8358; </span> <?php echo $total_price; ?> </p>
                                </td>
                                <td colspan="">
                                    <button type="submit" href="checkout-drinks-cart.php" class="btn btn-outline-info" onclick="return confirm('Do you wish to make your payment?'); " name="checkout_submit">
                                        <i class='fa fa-credit-card fa-1x'></i> Checkout
                                    </button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>

        <footer class="text-center">
            <h3 class="text-center" style="font-family: arial;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise <br />
                &copy; Trey Corporation
            </h3>
        </footer>
    </div>


    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/staff-main.js"> </script>
</body>

</html>