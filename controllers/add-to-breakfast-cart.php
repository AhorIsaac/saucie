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
    $breakfastAlreadyInCart = $food->breakfastInCart($food_id, $user_id);

    if (!$breakfastAlreadyInCart) {
        $breakfast = new Food();
        $addBreakfastToCart = $breakfast->addBreakfastToCart($fields);

        if ($addBreakfastToCart === TRUE) {
            $food = new Food();
            $cartNum = $food->rowCountBreakfastCart($user_id);

            session_start();
            $_SESSION["cartNum"] = $cartNum;
            $_SESSION['breakfast_added_to_cart'] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> <i class="fa fa-cart-plus fa-1x"></i> Successful! </h3>
                    <p> Product successfully added to cart! </p>
            </div>';
            header("location: ../views/food-breakfast.php");
            exit();
        }
    } else {
        $food = new Food();
        $updateBreakfastCart = $food->updateBreakfastCart($quantity, $food_id, $user_id);

        if ($updateBreakfastCart === TRUE) {
            session_start();
            $_SESSION['breakfast_already_in_cart'] =
                '<div class="alert alert-warning alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Product in <i class="fa fa-cart-plus fa-1x"></i> </h3>
                    <p> Product already in cart! <br />
                     Quantity updated! </p>
            </div>';
            header("location: ../views/food-breakfast.php");
            exit();
        }
    }
}
