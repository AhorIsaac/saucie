<?php
session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}


if(!$_SESSION["cus_name"]) {
    header("location: ../views/customers-sign-in.php");
}

if(isset($_SESSION["cus_id"])) {
    $user_id = $_SESSION["cus_id"];
    
    $deleteCart = new Food();
    $del = $deleteCart->deleteAllFromDinnerCart( $user_id );
    
    if($del == TRUE ) {
        session_start();
        $_SESSION["delete_all_dinner_success"] = '
            <div class="alert alert-success alert-dismissible fade show text-center" style="font-family: ubuntu mono; display: inline-block;">
                <button role="button" class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h3 class="alert-heading">  <i class="fa fa-trash-alt fa-1x"></i> <i class="fa fa-cart-plus fa-1x"></i> Successful! </h3>
                <p> Products deleted from cart! </p>
            </div>
        ';
        header("location: ../views/food-dinner.php");
        exit();
        
    }
}
