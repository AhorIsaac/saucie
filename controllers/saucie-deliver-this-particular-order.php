<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (isset($_GET["ref_no"])) {
    $order_ref_no = $_GET["ref_no"];
    $staff_id = $_SESSION["staff_id"];
    $order_table_name = $_SESSION["order_table_name"];

    $order = new Order();

    $deliverOrder = $order->deliverOrder($order_ref_no, $order_table_name, $staff_id);

    if ($deliverOrder === TRUE) {
        $_SESSION['deliver_order'] =
            '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: monospace; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading font-weight-bold"> <i class="fa fa-check-circle fa-1x"></i>
             <i class="fa fa-shopping-cart fa-1x"></i> Order Successfully Delivered! </h6>
        </div>';
        header("location: ../views/saucie-pending-order.php");
        exit();
    }
}
