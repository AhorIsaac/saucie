<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (isset($_POST["addToCart"])) {
    $food_id = $_POST["food_id"];
    $user_id = $_POST["user_id"];
    $quantity = $_POST["quantity"];

    $fields = [
        "food_id" => $food_id,
        "user_id" => $user_id,
        "quantity" => $quantity
    ];

    $food = new Food();
    $lunchAlreadyInCart = $food->lunchInCart($food_id, $user_id);

    if (!$lunchAlreadyInCart) {
        $lunch = new Food();
        $addLunchToCart = $lunch->addLunchToCart($fields);

        if ($addLunchToCart === TRUE) {
            $food = new Food();
            $cartNum = $food->rowCountLunchCart($user_id);

            session_start();
            $_SESSION["cartNum"] = $cartNum;
            $_SESSION['lunch_added_to_cart'] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> <i class="fa fa-cart-plus fa-1x"></i> Successful! </h3>
                    <p> Product successfully added to cart! </p>
            </div>';
            header("location: ../views/food-lunch.php");
            exit();
        }
    } else {
        $food = new Food();
        $updateLunchCart = $food->updateLunchCart($quantity, $food_id, $user_id);

        if ($updateLunchCart === TRUE) {
            session_start();
            $_SESSION['lunch_already_in_cart'] =
                '<div class="alert alert-warning alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Product in <i class="fa fa-cart-plus fa-1x"></i> </h3>
                    <p> Product already in cart! <br />
                     Quantity updated! </p>
            </div>';
            header("location: ../views/food-lunch.php");
            exit();
        }
    }
}
