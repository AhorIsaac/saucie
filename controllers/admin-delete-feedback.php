<?php

session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

if(isset($_GET["feedback_id"])) {
    $id = $_GET["feedback_id"];

    $message = new Message();
    $delete = $message->deleteFeedback($id);

    if ($delete == TRUE) {
        $_SESSION["delete_feedback"] = 
        '<div class="alert alert-success text-center alert-dismissible fade show" style="font-family: monospace; font-size: 13px; display: inline-block;">
            <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
            <h6 class="alert-heading"> <i class="fa fa-comment-dots fa-1x"></i> Deleted!  </h6>
            <p class=""> Feedback successfully deleted! </p>
        </div>';            
        header("location: ../views/admin-view-feedback.php");
        exit();
    }
}

?>