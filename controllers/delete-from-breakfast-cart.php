<?php
session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

if(isset($_GET["food_id"])) {
    $food_id = $_GET["food_id"];
    $user_id = $_SESSION["cus_id"];
    
    $food = new Food();
    $deleteFood = $food->deleteFromBreakfastCart($food_id, $user_id);
    
    if($deleteFood === TRUE) {
        session_start();
        $_SESSION["delete_breakfast_success"] = '
            <div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h3 class="alert-heading"> <i class="fa fa-trash-alt fa-1x"></i> <i class="fa fa-cart-plus fa-1x"></i> Successful! </h3>
                <p> Product(s) deleted from cart! </p>
            </div>
        ';
        
        $numCount = new Food();
        $numCart = $numCount->rowCountBreakfastCart( $user_id );
        if( $numCart == 0 ) {
            unset( $_SESSION["delete_breakfast_success"] );
        }
        
        header("location: ../views/food-breakfast-view.php");
        exit();
    }
}
