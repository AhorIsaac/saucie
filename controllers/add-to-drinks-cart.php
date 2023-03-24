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
    $drinkAlreadyInCart = $food->drinkInCart($food_id, $user_id);

    if (!$drinkAlreadyInCart) {
        $drink = new Food();
        $addDrinkToCart = $drink->addDrinkToCart($fields);

        if ($addDrinkToCart === TRUE) {
            $food = new Food();
            $cartNum = $food->rowCountDrinksCart($user_id);

            session_start();
            $_SESSION["cartNum"] = $cartNum;
            $_SESSION['drink_added_to_cart'] =
                '<div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> <i class="fa fa-cart-plus fa-1x"></i> Successful! </h3>
                    <p> Product successfully added to cart! </p>
            </div>';
            header("location: ../views/food-drinks.php");
            exit();
        }
    } else {
        $food = new Food();
        $updateDrinksCart = $food->updateDrinksCart($quantity, $food_id, $user_id);

        if ($updateDrinksCart === TRUE) {
            session_start();
            $_SESSION['drink_already_in_cart'] =
                '<div class="alert alert-warning alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                    <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h3 class="alert-heading"> Product in <i class="fa fa-cart-plus fa-1x"></i> </h3>
                    <p> Product already in cart! <br />
                     Quantity updated! </p>
            </div>';
            header("location: ../views/food-drinks.php");
            exit();
        }
    }
}
