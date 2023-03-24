<?php

session_start();
     
function __autoload($Class) {
    require_once("../classes/$Class.php");
}

$ref = random_int(1, 100000);

if(isset($_SESSION["userDetails"])) {

    foreach($_SESSION["userDetails"] as $details) {
        
        $food = new Food();
        $movedFood = $food->moveToDinnerOrderTable($ref, $_SESSION["cus_id"], $details["foodId"], $details["cartQuantity"], $details["foodPrice"], (int)$details["foodPrice"] * (int)$details["cartQuantity"]);
    }
    
    $order = new Order();
    $delivery_address = $order->updateOrderAddress('order_table_dinner', $_SESSION["address"], $ref);
    
    $del = new Food();
    $clearDinnerCart = $del->deleteAllFromDinnerCart( $_SESSION["cus_id"] );
    
    if($clearDinnerCart == TRUE) {
        session_start();
        $_SESSION["process_success"] = true;             
        header("location: ../views/checkout-dinner-cart.php");
        exit();        
    }
    
} else {
    echo "Error";
    exit();
}
