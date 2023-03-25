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
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        .my-navbar {
            font-family: "Arial";
            color: orange;
        }

        .nav-link {
            color: orange;
            font-size: 15px;
            font-weight: 600;
        }

        .navbar-brand {
            font-size: 25px;
        }

        .nav-item:hover {
            background: orange;
        }

        .nav-item {
            margin-left: 15px;
            margin-right: 15px;
            border: 20px;
        }

        body {
            font-family: "Arial";
        }

        #category {
            border: 1px double antiquewhite;
            box-shadow: 0 0 1px 1px antiquewhite;
        }

        #item_images {
            width: 310px;
            height: 220px;
            border: 3px solid dimgray;
        }

        .category-frame {
            border: 1px solid antiquewhite;
            border-radius: 5px;
            box-shadow: 0 0 1px 1px antiquewhite;
            margin: auto;
        }

        #img_carousel {
            width: 800px;
            height: 500px;
        }

        #carousel_slider {
            border: 1px solid orange;
            background-color: #333;
        }

        #main_image {
            width: 600px;
            height: 340px;
        }

        .dropdown-item {
            font-weight: bold;
        }

        #icon_img {
            width: 50px;
            height: 50px;
            border-radius: 25px;
            border: 1px solid antiquewhite;
            box-shadow: 0 0 1px 1px antiquewhite;
        }

        #introductory_text {
            font-family: "Ubuntu Mono";
            border-radius: 10px;
            box-shadow: 0 0 2px 1px antiquewhite;
            border: 1px solid antiquewhite;
            background-image: url("../public/storage/food_images/4000.jpg");
            background-size: cover;
            font-size: 28px;
        }

        .home-quote {
            color: white;
            text-shadow: 1px 2px black;
        }

        #feedback_frame {
            border: 1px solid antiquewhite;
        }

        #user_img {
            width: 100px;
            height: 100px;
            border-radius: 50px;
        }

        .dropdown-item:hover {
            background-color: antiquewhite;
        }

        #food_img {
            width: 220px;
            height: 120px;
            border-radius: 8px;

        }

        #meal_frame:hover {
            transform: translate(0px, 10px);
            transition: transform 500ms ease-in-out;
        }
    </style>
</head>

<body>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top p-4 my-navbar shadow" id="navigation">
            <a href="#" class="navbar-brand text-dark p-4"> <i class="fa fa-cookie-bite fa-1x"></i> Saucie </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarMenu">
                <span class="navbar-toggler-icon text-dark"></span>
            </button>
            <div class="collapse navbar-collapse text-center" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item dropdown font-weight-bold">
                        <a class="nav-link dropdown-toggle" href="#" id="foodCategory" data-toggle="dropdown"> Food Category </a>
                        <div class="dropdown-menu text-center" aria-labelledby="foodCategory" id="category">
                            <a class="dropdown-item" href="food-breakfast.php"> Breakfast </a>
                            <a class="dropdown-item" href="food-lunch.php"> Lunch </a>
                            <a class="dropdown-item" href="food-dinner.php"> Dinner </a>
                            <a class="dropdown-item" href="food-drinks.php"> Drinks </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#carousel_slider" class="nav-link"> Saucie <i class="fa fa-images fa-1x"></i> </a>
                    </li>
                    <li class="nav-item">
                        <a href="#food_items" class="nav-link"> Saucie Foods </a>
                    </li>
                    <li class="nav-item">
                        <a href="#feedback_section" class="nav-link"> Customers Review </a>
                    </li>
                    <li class="nav-item">
                        <a href="users-login.php" class="nav-link">
                            <i class="fa fa-lock-open fa-1x"></i> Login
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <br />

        <div class="row jumbotron  p-5 bg-transparent justify-content-around" id="introductory_text">
            <div class="col-sm-10">
                <p class="text-center font-weight-bold p-5 m-5 text-white">
                    <q class="home-quote">
                        If you really want to make a friend, go to someone's house and eat with him... the people
                        who give you their food give you their heart <i class="fa fa-heart fa-1x"></i>.
                    </q>
                </p>
            </div>
        </div>

        <div class="text-center container-fluid border mt-3 mb-3" id="food_items" style="border-radius: 15px;">
            <?php
            $number = random_int(1, 18);

            $food = new Food();
            $breakfast = "Breakfast";
            $lunch = "Lunch";
            $dinner = "Dinner";
            $drinks = "Drinks";

            $breakfastMeals = $food->selectSaucieFood($breakfast, $number);
            $lunchMeals = $food->selectSaucieFood($lunch, $number);
            $dinnerMeals = $food->selectSaucieFood($dinner, $number);
            $drinksMeals = $food->selectSaucieFood($drinks, $number);

            ?>

            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h6 class="font-weight-bold text-info"> Few Selected Breakfast Meals </h6>
                    <div class="row justify-content-around">
                        <?php
                        foreach ($breakfastMeals as $meal) { ?>
                            <div class="col-md-6 mt-1 mb-1" id="meal_frame">
                                <img src="../public/storage/uploaded_food/<?php echo $meal["image"]; ?>" id="food_img" alt="" />
                                <p class="text-dark"> Price Tag : <span>&#8358;</span><?php echo $meal["price_tag"]; ?> </p>
                                <a href="users-login.php" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fa fa-cart-plus fa-1x"></i> Order
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mb-3">
                    <h6 class="font-weight-bold text-info"> Few Selected Lunch Meals </h6>
                    <div class="row justify-content-around">
                        <?php
                        foreach ($lunchMeals as $meal) { ?>
                            <div class="col-md-6 mt-1 mb-1" id="meal_frame">
                                <img src="../public/storage/uploaded_food/<?php echo $meal["image"]; ?>" id="food_img" alt="" />
                                <p class="text-dark"> Price Tag : <span>&#8358;</span><?php echo $meal["price_tag"]; ?> </p>
                                <a href="users-login.php" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fa fa-cart-plus fa-1x"></i> Order
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>



            <div class="row">
                <div class="col-md-6 mt-3 mb-3">
                    <h6 class="font-weight-bold text-info"> Few Selected Breakfast Meals </h6>
                    <div class="row justify-content-around">
                        <?php
                        foreach ($dinnerMeals as $meal) { ?>
                            <div class="col-md-6 mt-1 mb-1" id="meal_frame">
                                <img src="../public/storage/uploaded_food/<?php echo $meal["image"]; ?>" id="food_img" alt="" />
                                <p class="text-dark"> Price Tag : <span>&#8358;</span><?php echo $meal["price_tag"]; ?> </p>
                                <a href="users-login.php" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fa fa-cart-plus fa-1x"></i> Order
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-md-6 mt-3 mb-3">
                    <h6 class="font-weight-bold text-info"> Few Selected Lunch Meals </h6>
                    <div class="row justify-content-around">
                        <?php
                        foreach ($drinksMeals as $meal) { ?>
                            <div class="col-md-6 mt-1 mb-1" id="meal_frame">
                                <img src="../public/storage/uploaded_food/<?php echo $meal["image"]; ?>" id="food_img" alt="" />
                                <p class="text-dark"> Price Tag : <span>&#8358;</span><?php echo $meal["price_tag"]; ?> </p>
                                <a href="users-login.php" class="btn btn-outline-info btn-sm shadow">
                                    <i class="fa fa-cart-plus fa-1x"></i> Order
                                </a>
                            </div>
                        <?php } ?>
                    </div>
                </div>

            </div>


        </div>

    </div>


    <div class="container">

        <h3 class="text-center mt-5"> Customers Review </h3>

        <div class="row justify-content-around  mb-4 mt-4 text-center" id="feedback_section">
            <?php
            $message = new Message();
            $compliments = $message->selectFeedbackMessages();

            foreach ($compliments as $feedback) {
            ?>
                <div class="col-md-3 col-lg-3 col-sm-5 text-center ml-2 mr-2 mt-3 mb-3 shadow bg-white" style="min-width: 300px;" id="feedback_frame">
                    <img class="card-img-top mt-2" src="../public/storage/customer_profileimage/<?php echo $feedback["user_image"]; ?>" alt="" id="user_img" />
                    <div class="text-center" style="font-family: monospace;">
                        <h5 class="" style="font-family: monospace" ;>
                            <span style="font-family: monospace; font-weight: bold"> </span> <?php echo $feedback["user_name"];  ?>
                        </h5>
                        <p class="text-center font-weight-bold"> <?php echo $feedback["title"]; ?> </p>
                        <p class='text-center text-info' style="font-size: 16px;">
                            <?php echo $feedback["message"]; ?>
                        </p>
                    </div>
                </div>
            <?php } ?>
        </div>

    </div>

    <div class="jumbotron container text-center shadow-lg bg-white" id="carousel_slider">
        <h3 class="m-3 text-dark"> Photo Speaks </h3>
        <div id="carousel-example-generic" class="carousel slide" data-ride="carousel" data-interval="2000">
            <ol class="carousel-indicators">
                <li data-target="#carousel-exampel-generic" data-slide-to="0" class="active"> </li>
                <li data-target="#carousel-exampel-generic" data-slide-to="1"> </li>
                <li data-target="#carousel-exampel-generic" data-slide-to="2"> </li>
                <li data-target="#carousel-exampel-generic" data-slide-to="3"> </li>
                <li data-target="#carousel-exampel-generic" data-slide-to="4"> </li>
                <li data-target="#carousel-exampel-generic" data-slide-to="5"> </li>
            </ol>

            <div class="carousel-inner" role="listbox">
                <div class="carousel-item active">
                    <img src="../public/storage/food_images/restaurant-kitchen.jpg" alt="First Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Restaurant Kitchen </h2>
                        <p> The <i class="fa fa-home fa-1x"></i> of proper diet and nutrition </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="../public/storage/food_images/restaurant-1.jpg" alt="Second Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Restaurant </h2>
                        <p> Very comforting and conducive! </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="../public/storage/food_images/wine-shelve.jpg" alt="Third Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Wines </h2>
                        <p> Always at your service! </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="../public/storage/food_images/restaurant-4.jpg" alt="Third Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Restaurant </h2>
                        <p> The best place to enjoy your meal! </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="../public/storage/food_images/restaurant-kit.jpg" alt="Third Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Kitchen </h2>
                        <p> The world best meals are made from this amazing complex </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <img src="../public/storage/food_images/restaurant-kitche.jpg" alt="Third Slide" id="img_carousel" />
                    <div class="carousel-caption">
                        <h2> Saucie Wines </h2>
                        <p> Always at your service! </p>
                    </div>
                </div>

            </div>

            <a class="carousel-control-prev" href="#carousel-example-generic" role="button" data-slide="prev">
                <i class="fa fa-arrow-alt-circle-left fa-1x text-primary"></i>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-generic" role="button" data-slide="next">
                <i class="fa fa-arrow-alt-circle-right fa-1x text-primary"></i>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>


    <div class="row justify-content-around bg-white jumbotron shadow">
        <div class="col-sm-4">
            <footer class="text-center">
                <h3 class="text-center">
                    <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                </h3>
            </footer>
        </div>
        <div class="col-sm-4 text-center">
            <a href="#"> <img src="../public/project_icons/facebook.png" alt="" id="icon_img" /> </a>
            <a href="#"> <img src="../public/project_icons/Instagram.png" alt="" id="icon_img" /> </a>
            <a href="#"> <img src="../public/project_icons/skype.png" alt="" id="icon_img" /> </a>
            <a href="#"> <img src="../public/project_icons/Twitter.png" alt="" id="icon_img" /> </a>
            <a href="#"> <img src="../public/project_icons/youtube_flat.png" alt="" id="icon_img" /> </a>
        </div>
    </div>
    </div>

    <script src="../public/scripts/jquery-3.3.1.js"></script>
    <script src="../public/js/bootstrap.bundle.min.js"></script>
    <script src="../public/fontawesome/js/all.js"> </script>
</body>

</html>