<?php

session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

/*
function checkValidRefNo($input) {
    $order = new Order();
    $checkRefno = $order->validRefNo($input);
}
*/

if(isset($_POST["assign_order"])) {
    $staff_id = $_POST["staff_id"];
    $admin_id = $_POST["admin_id"];
    $ref_no = $_POST["ref_no"];
    
    $order = new Order();
        
    $assignOrder = $order->assignOrder($staff_id, $ref_no, $admin_id);
    
    if($assignOrder === TRUE) {
        $_SESSION['assign_order_success'] = 
        '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading font-weight-bold"> Order successfully assigned! </h6>
        </div>';
        header("location: ../views/saucie-pending-order.php");
        exit();
    }
}
