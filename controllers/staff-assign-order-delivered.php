<?php

session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

if(isset($_GET["staff_id"])) {
    $staff_id = $_GET["staff_id"];
    $msg = new Message();
    $deliverAssignedOrder = $msg->assignOrderDelivered($staff_id);
    
    $order = new Order();
    $clearAssignedOrder = $order->deleteAssignOrder($staff_id);
    
    if($deliverAssignedOrder > 0) {
        header("location: ../views/staff-homepage.php");
        exit();
    }
}
