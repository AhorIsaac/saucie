<?php

session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!($_SESSION['admin_name'])) {
    header("location: users-login.php");
}

$welldone = "Welldone";
$complaints = "Complaint";
$recommendation = "Recommendation";

$message = new Message();
$feedback_goodjob = $message->selectAllFeedbackMessages($welldone);
$feedback_complaints = $message->selectAllFeedbackMessages($complaints);
$feedback_recommendation = $message->selectAllFeedbackMessages($recommendation);

?>


<!DOCTYPE html>
<html>

<head>
    <title> Saucie </title>
    <meta charset='utf-8'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../public/css/litera-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="../public/css/main-style.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #pimg {
            width: 70px;
            height: 70px;
            border-radius: 35px;
        }

        #user_img {
            width: 70px;
            height: 70px;
            border-radius: 35px;

        }

        table h4 {
            font-family: monospace;
        }

        .nav-link:hover {
            color: black;
            background-color: orange;
        }

        td {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">
            <a href="#" class="navbar-brand">
                <h3> <i class="fa fa-cookie-bite fa-2x"></i> Saucie </h3>
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon"> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item mt-4 mr-3 font-weight-bold text-center">
                        <a href="admin-homepage.php" class="nav-link">
                            <i class="fa fa-home fa-1x"></i> Admin Homepage
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#goodjob" class="nav-link">
                            Good Job
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#complaints" class="nav-link">
                            Complaints
                        </a>
                    </li>
                    <li class="nav-item mt-4 mr-2 font-weight-bold text-center">
                        <a href="#recommendation" class="nav-link">
                            Recommendation
                        </a>
                    </li>
                    <li class="nav-item active text-center">
                        <a href="#" class=" text-center">
                            <img src="../public/storage/admin_profileimage/<?php echo $_SESSION["admin_profileimage"]; ?>" alt="" id="pimg" class="text-center" />
                            <span class="sr-only">(current)</span>
                        </a>
                        <h6 class="text-center font-weight-bold"> <?php echo $_SESSION["admin_name"]; ?> </h6>
                    </li>
                </ul>
            </div>
        </nav>

        <header class="text-center mt-3 mb-3">
            <h3 class="text-info"> Saucie <i class="fa fa-comment-alt fa-1x"></i> Feedback Page </h3>
        </header>

        <div class="text-center mt-4 mb-4">
            <?php
            if (isset($_SESSION["delete_feedback"])) {
                echo $_SESSION["delete_feedback"];
                unset($_SESSION["delete_feedback"]);
            }
            ?>
        </div>

        <div class="text-center mt-5 mb-5 bg-light shadow" id="goodjob">
            <h2 class="mt-3 mb-3" style="font-family: monospace;"> Good Job Feedbacks </h2>
            <?php
            foreach ($feedback_goodjob as $feedback) { ?>
                <div class="row mt- mb-3 text-center">
                    <div class="col-md-2 mt-2">
                        <img src="../public/storage/customer_profileimage/<?php echo $feedback["user_image"] ?>" id="user_img" />
                        <h6 class='text-center font-weight-bold'> <?php echo $feedback["user_name"]; ?> </h6>
                    </div>
                    <div class="col-md-2 mt-2">
                        <h6 class="text-center font-weight-bold"> <?php echo $feedback["title"]; ?> </h6>
                    </div>
                    <div class="col-md-5 mt-2">
                        <p class="text-center text-success"> <?php echo $feedback["message"]; ?> </p>
                    </div>
                    <div class="col-md-3 mt-2 mb-2">
                        <a href="admin-mark-feedback-as-read.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-info btn-sm <?php if ($feedback["seen"] == 1) { ?> disabled <?php } ?>" onclick="return confirm('Do you want to mark this feedback as read?'); ">
                            <i class="fa fa-check-circle fa-1x"></i> <?php if ($feedback["seen"] == 1) {
                                                                            echo "message read";
                                                                        } else {
                                                                            echo " mark as read";
                                                                        } ?>
                        </a>
                        <a href="admin-delete-feedback.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this feedback?'); ">
                            <i class="fa fa-trash-alt fa-1x"></i> delete
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="text-center mt-5 mb-5 bg-light shadow" id="complaints">
            <h2 class="mt-3 mb-3" style="font-family: monospace;"> Complaints Feedbacks </h2>
            <?php
            foreach ($feedback_complaints as $feedback) { ?>
                <div class="row mt- mb-3 text-center">
                    <div class="col-md-2 mt-2">
                        <img src="../public/storage/customer_profileimage/<?php echo $feedback["user_image"] ?>" id="user_img" />
                        <h6 class='text-center font-weight-bold'> <?php echo $feedback["user_name"]; ?> </h6>
                    </div>
                    <div class="col-md-2 mt-2">
                        <h6 class="text-center font-weight-bold"> <?php echo $feedback["title"]; ?> </h6>
                    </div>
                    <div class="col-md-5 mt-2">
                        <p class="text-center text-success"> <?php echo $feedback["message"]; ?> </p>
                    </div>
                    <div class="col-md-3 mt-2 mb-2">
                        <a href="admin-mark-feedback-as-read.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-info btn-sm <?php if ($feedback["seen"] == 1) { ?> disabled <?php } ?>" onclick="return confirm('Do you want to mark this feedback as read?'); ">
                            <i class="fa fa-check-circle fa-1x"></i> <?php if ($feedback["seen"] == 1) {
                                                                            echo "message read";
                                                                        } else {
                                                                            echo " mark as read";
                                                                        } ?>
                        </a>
                        <a href="admin-delete-feedback.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this feedback?'); ">
                            <i class="fa fa-trash-alt fa-1x"></i> delete
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="text-center mt-5 mb-5 bg-light shadow" id="recommendation">
            <h2 class="mt-3 mb-3" style="font-family: monospace;"> Recommendation Feedbacks </h2>
            <?php
            foreach ($feedback_recommendation as $feedback) { ?>
                <div class="row mt- mb-3 text-center">
                    <div class="col-md-2 mt-2">
                        <img src="../public/storage/customer_profileimage/<?php echo $feedback["user_image"] ?>" id="user_img" />
                        <h6 class='text-center font-weight-bold'> <?php echo $feedback["user_name"]; ?> </h6>
                    </div>
                    <div class="col-md-2 mt-2">
                        <h6 class="text-center font-weight-bold"> <?php echo $feedback["title"]; ?> </h6>
                    </div>
                    <div class="col-md-5 mt-2">
                        <p class="text-center text-success"> <?php echo $feedback["message"]; ?> </p>
                    </div>
                    <div class="col-md-3 mt-2 mb-2">
                        <a href="admin-mark-feedback-as-read.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-info btn-sm <?php if ($feedback["seen"] == 1) { ?> disabled <?php } ?>" onclick="return confirm('Do you want to mark this feedback as read?'); ">
                            <i class="fa fa-check-circle fa-1x"></i> <?php if ($feedback["seen"] == 1) {
                                                                            echo "message read";
                                                                        } else {
                                                                            echo " mark as read";
                                                                        } ?>
                        </a>
                        <a href="admin-delete-feedback.php?feedback_id=<?php echo $feedback["id"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Do you want to delete this feedback?'); ">
                            <i class="fa fa-trash-alt fa-1x"></i> delete
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>


        <footer class="text-center m-3 p-3">
            <h3 class="text-center" style="color: black">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>
    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
    <script src="../public/js/main.js"> </script>
</body>

</html>