<?php

session_start();

function __autoload($Class) {
    require_once("../classes/$Class.php");
}

if(isset($_GET["feedback_id"])) {
    $id = $_GET["feedback_id"];

    $message = new Message();
    $mark_as_read = $message->markAsRead($id);

    if ($mark_as_read == TRUE) {
        header("location: ../views/admin-view-feedback.php");
        exit();
    }
}
