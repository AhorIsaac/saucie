<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}


if (!$_SESSION["cus_name"]) {
    header("location: customers-sign-in.php");
}

// function that checks if html input is empty
function checkIfEmpty($inputName)
{
    if (empty($inputName)) {
        session_start();
        $_SESSION['feedback_error'] =
            '<div class="alert alert-danger text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h3 class="alert-heading"> An Error Occurred! </h3>
                <p class=""> All input entries are required. </p>
            </div>';
        header("location: send-feedback.php");
        exit();
    } else {
        return $inputName;
    }
}


if (isset($_POST["send_feedback"])) {
    $user_id = $_POST["user_id"];
    $feedback_message = $_POST["feedback_message"];
    $feedback_title = $_POST["feedback_title"];
    $feedback_subject = $_POST["feedback_subject"];

    $user_id = checkIfEmpty($user_id);
    $feedback_message = checkIfEmpty($feedback_message);
    $feedback_title = checkIfEmpty($feedback_title);

    $fields = [
        "user_id" => $user_id,
        "feedback_title" => $feedback_title,
        "feedback_subject" => $feedback_subject,
        "feedback_message" => $feedback_message
    ];

    $feedback = new Message();
    $sendFeedback = $feedback->sendFeedback($fields);

    if ($sendFeedback == TRUE) {
        session_start();
        $_SESSION['feedback_success'] =
            '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: Ubuntu Mono; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h3 class="alert-heading"> <i class="fa fa-comments fa-1x"></i> Delivered! </h3>
                <p class=""> Message sent successfully.  <br />
                 Thank you for your opinion! </p>
            </div>';
        header("location: customers-homepage.php");
        exit();
    }
}

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
        label {
            color: black;
        }

        input[type="text"],
        select,
        textarea {
            border: 2px solid antiquewhite;
        }

        #main {
            border: 2px solid antiquewhite;
        }

        select {
            color: black;
            border: 2px solid antiquewhite;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center m-3 p-2">
            <h1 class=""> <i class="fa fa-cookie-bite fa-1x"></i> Saucie </h1>
        </header>

        <div class="text-center">
            <?php
            if (isset($_SESSION['feedback_error'])) {
                echo $_SESSION['feedback_error'];
                unset($_SESSION['feedback_error']);
            }
            ?>
        </div>

        <div class="jumbotron shadow-lg bg-white" id="main">
            <h4 class="text-center">
                <i class="fa fa-comments fa-1x"></i> Feedback
            </h4>
            <form method="POST" class="form">
                <input type="hidden" name="user_id" value="<?php echo $_SESSION["cus_id"]; ?>">
                <div class="form-group row font-weight-bold">
                    <label for="feedbackTitle" class="col-form-label col-md-3 text-right"> Title </label>
                    <div class="col-md-7">
                        <input type="text" name="feedback_title" id="feedbackTitle" class="form-control" placeholder="Input Feedback Title">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="feedbackSubject" class="col-form-label col-md-3 text-right  font-weight-bold"> Category </label>
                    <div class="col-md-7">
                        <select name="feedback_subject" id="feedbackSubject" class="form-control">
                            <option value="Recommendation" selected> Recommendation </option>
                            <option value="Complaint"> Complaint </option>
                            <option value="Welldone"> Good Job </option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="feedbackMessage" class="col-form-label col-md-3 text-right  font-weight-bold"> Message </label>
                    <div class="col-md-7">
                        <textarea class="form-control" cols="60" rows="7" placeholder="Enter your message" name="feedback_message">
                             </textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="buttons" class="col-form-label col-md-3 text-right"> </label>
                    <div class="col-md-7">
                        <input type="reset" value="Reset" class="btn btn-secondary">
                        <input type="submit" value="Send Feedback" name="send_feedback" class="btn btn-info">
                    </div>
                </div>
            </form>
        </div>


        <footer class="text-center m-3 p-2">
            <h2 class="">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h2>
        </footer>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>

    <script src="../public/js/main.js"> </script>

</body>

</html>