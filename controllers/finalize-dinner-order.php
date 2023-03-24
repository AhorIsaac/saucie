<?php
session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

if ($_SESSION["process_success"]) { 
    $_SESSION["order_success"] = 
    '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
        <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
        <h3 class="alert-heading"> <i class="fa fa-shopping-cart fa-1x"></i> Successful ! </h3>
        <p class=""> Your order was successful. <br />
        Thanks for shopping with us!</p>
    </div>';            
    header("location: ../views/customers-homepage.php");
    exit();
}
