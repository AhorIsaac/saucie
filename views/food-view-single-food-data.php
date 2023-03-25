<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
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
    <link href="../public/css/staff-style.css" type="text/css" rel="stylesheet">
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        body {
            font-family: monospace;
        }

        #food_frame {
            font-family: monospace;
            border: 1px solid dimgray;
            border-radius: 10px;
        }

        #food_profile_image {
            border-radius: 25px;
            width: 420px;
            height: 200px;
        }

        .my-info p {
            font-family: monospace;
            color: black;
            font-size: 18px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center pt-3">
            <h1 class="text-center mt-4 mb-4" style="font-family: ubuntu mono;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h1>
        </header>

        <h2 class="text-center mt-4 mb-4" style="font-family: monospace;">
            Food Information Page
        </h2>

        <?php
        $id = $_GET['id'];
        $food = new Food();
        $foodDetails = $food->selectOneFoodInfo($id);
        ?>
        <div class="jumbotron text-center justify-content-center bg-light shadow-lg" id="food_frame">
            <div class="text-center">
                <div class="text-center">
                    <div class="text-center ml-1">
                        <img src="../public/storage/uploaded_food/<?php echo $foodDetails["image"]; ?>" alt="" id="food_profile_image" class="shadow-sm" />
                    </div>
                    <div class="text-center mt-1 my-info">
                        <p class="">
                            <span class="font-weight-bold"> Name </span> : <?php echo $foodDetails["name"]; ?>
                        </p>
                        <p class="">
                            <span class="font-weight-bold"> Category </span> : <?php echo $foodDetails["category"]; ?>
                        </p>
                        <p class="">
                            <span class="font-weight-bold"> Description </span> : <?php echo $foodDetails["description"]; ?>
                        </p>
                        <p class="">
                            <span class="font-weight-bold"> Price Tag </span> : <span> &#8358; </span> <?php echo $foodDetails["price_tag"]; ?>
                        </p>
                        <p class="">
                            <span class="font-weight-bold"> Quantity </span> : <?php echo $foodDetails["quantity"]; ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <footer class="text-center">
            <h3 class="text-center" style="font-family: ubuntu mono;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
            </h3>
        </footer>
    </div>



    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>

    <script src="../public/js/staff-main.js"> </script>
</body>

</html>