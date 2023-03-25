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
            background-attachment: fixed;
            background-size: cover;
        }

        #dlinks {
            border-radius: 25px;
            border: 1px solid dimgray;
        }

        #dlinks:hover {
            background: orange;
        }

        #food_img {
            width: 100px;
            height: 70px;
            border-radius: 8px;

        }

        #users_img {
            width: 80px;
            height: 80px;
            border-radius: 40px;
        }

        th {
            color: black;
            font-size: 18px;
        }

        td {
            color: black;
        }

        #breakfast,
        #lunch,
        #dinner,
        #drinks {
            border: 1px solid antiquewhite;
            border-radius: 10px;
        }

        #food_profile_image {
            border-radius: 25px;
            width: 250px;
            height: 100px;
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar" class="bg-dark">

            <h1 href="#" class="text-secondary text-center m-3"> <i class="fa fa-cookie-bite fa-1x"></i> Saucie </h1>
            <div class="p-4 pt-5">

                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle"> Food Sections </a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li>
                                <a href="#breakfast"> Breakfast </a>
                            </li>
                            <li>
                                <a href="#lunch"> Lunch </a>
                            </li>
                            <li>
                                <a href="#dinner"> Dinner </a>
                            </li>
                            <li>
                                <a href="#drinks"> Drinks </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="food-summary.php" target="_blank">
                            <i class="fa fa-th-list fa-1x"></i> Food Summary
                        </a>
                    </li>
                    <li>
                        <a href="upload-products.php">
                            <i class="fa fa-upload"></i> Upload Saucie Products
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5">

            <nav class="navbar navbar-expand-lg navbar-light bg-light shadow">

                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
                        <i class="fa fa-bars"></i>
                        <span class="sr-only">Toggle Menu</span>
                    </button>

                    <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="nav navbar-nav ml-auto">
                            <?php if (isset($_SESSION["admin_id"])) {  ?>
                                <li class="nav-item active m-2 text-center" id="dlinks">
                                    <a href="admin-homepage.php" class="nav-link">
                                        Return to Admin Homepage
                                    </a>
                                </li>
                            <?php } ?>

                            <?php if (isset($_SESSION["staff_id"])) { ?>
                                <li class="nav-item m-2 text-center" id="dlinks">
                                    <a href="staff-homepage.php" class="nav-link">
                                        Return to Staff Homepage
                                    </a>
                                </li>
                            <?php } ?>
                            <li class="nav-item m-2 text-center" id="dlinks">
                                <a href="upload-products.php" class="nav-link">
                                    Upload More
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <h2 class="mb-4"> Saucie Food Data Homepage! </h2>


            <div class="container-fluid pt-3 mt-3">

                <div class="text-center">
                    <?php if (isset($_SESSION["add_food_success"])) {
                        echo $_SESSION["add_food_success"];
                        unset($_SESSION["add_food_success"]);
                    } ?>

                    <?php if (isset($_SESSION['products_update_success'])) {
                        echo $_SESSION['products_update_success'];
                        unset($_SESSION['products_update_success']);
                    } ?>
                </div>

                <!-- BREAKFAST FRAME -->

                <div class="mt-4 mb-4">
                    <h3 class="text-center font-weight-bold" style="font-family: monospace;"> Breakfast Table </h3>
                    <table class="table-hover table-striped container-fluid mt-3 mb-4 ml-0 text-center bg-white shadow-lg">
                        <thead>
                            <tr>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Category </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Description </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Price </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Quantity </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class='fa fa-image fa-1x'></i> </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> View </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Delete </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Update </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $breakfastFood = new Food();
                            $breakfastmeals = $breakfastFood->selectAllBreakfastMeals();

                            foreach ($breakfastmeals as $breakfast) {
                                if ($breakfast["staff_id"] != null) {
                                    $uploader = new Staff();
                                    $uploaders_details = $uploader->selectOneStaffInfo($breakfast["staff_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_staff = $uploaders_details["profileimage"];
                                } else {
                                    $uploader = new Admin();
                                    $uploaders_details = $uploader->selectOneAdminInfo($breakfast["admin_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_admin = $uploaders_details["profileimage"];
                                }
                            ?>
                                <tr>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $breakfast["name"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $breakfast["category"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $breakfast["description"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <span>&#8358;</span><?php echo $breakfast["price_tag"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $breakfast["quantity"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $uploaders_name; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold">
                                        <?php if ($breakfast["staff_id"] != null) { ?>
                                            <img src="../public/storage/staff_profileimage/<?php echo $uploaders_image_staff; ?>" alt="" id="users_img" />
                                        <?php } else { ?>
                                            <img src="../public/storage/admin_profileimage/<?php echo $uploaders_image_admin; ?>" alt="" id="users_img" />
                                        <?php } ?>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-view-single-food-data.php?id=<?php echo $breakfast["id"]; ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-book-open fa-1x"></i> Info
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-delete-single-food-data.php?id=<?php echo $breakfast["id"]; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i> Delete
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-update-single-food-data.php?id=<?php echo $breakfast["id"]; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-sync fa-1x"></i> Update
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>

                <br />

                <!-- LUNCH FRAME -->

                <div class="mb-4 mt-4">
                    <h3 class="text-center font-weight-bold" style="font-family: monospace;"> Lunch Table </h3>
                    <table class="table-hover table-striped container-fluid mt-3 mb-4  ml-0 text-center bg-white shadow-lg" id="lunch">
                        <thead>
                            <tr>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Category </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Description </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Price </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Quantity </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class='fa fa-image fa-1x'></i> </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> View </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Delete </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Update </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $lunchFood = new Food();
                            $lunchmeals = $lunchFood->selectAllLunchMeals();

                            foreach ($lunchmeals as $lunch) {
                                if ($lunch["staff_id"] != null) {
                                    $uploader = new Staff();
                                    $uploaders_details = $uploader->selectOneStaffInfo($lunch["staff_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_staff = $uploaders_details["profileimage"];
                                } else {
                                    $uploader = new Admin();
                                    $uploaders_details = $uploader->selectOneAdminInfo($lunch["admin_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_admin = $uploaders_details["profileimage"];
                                }
                            ?>
                                <tr>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $lunch["name"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $lunch["category"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $lunch["description"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <span>&#8358;</span><?php echo $lunch["price_tag"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $lunch["quantity"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $uploaders_name; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold">
                                        <?php if ($lunch["staff_id"] != null) { ?>
                                            <img src="../public/storage/staff_profileimage/<?php echo $uploaders_image_staff; ?>" alt="" id="users_img" />
                                        <?php } else { ?>
                                            <img src="../public/storage/admin_profileimage/<?php echo $uploaders_image_admin; ?>" alt="" id="users_img" />
                                        <?php } ?>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-view-single-food-data.php?id=<?php echo $lunch["id"]; ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-book-open fa-1x"></i> Info
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-delete-single-food-data.php?id=<?php echo $lunch["id"]; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i> Delete
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-update-single-food-data.php?id=<?php echo $lunch["id"]; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-sync fa-1x"></i> Update
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>


                <br />


                <!-- DINNER FRAME -->

                <div class="mb-4 mt-4">
                    <h3 class="text-center font-weight-bold" style="font-family: monospace;"> Dinner Table </h3>
                    <table class="table-hover table-striped container-fluid  mt-3 mb-4  ml-0 text-center bg-white shadow-lg" id="dinner">
                        <thead>
                            <tr>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Category </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Description </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Price </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Quantity </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class='fa fa-image fa-1x'></i> </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> View </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Delete </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Update </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $dinnerFood = new Food();
                            $dinnermeals = $dinnerFood->selectAllDinnerMeals();

                            foreach ($dinnermeals as $dinner) {
                                if ($dinner["staff_id"] != null) {
                                    $uploader = new Staff();
                                    $uploaders_details = $uploader->selectOneStaffInfo($dinner["staff_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_staff = $uploaders_details["profileimage"];
                                } else {
                                    $uploader = new Admin();
                                    $uploaders_details = $uploader->selectOneAdminInfo($dinner["admin_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_admin = $uploaders_details["profileimage"];
                                }
                            ?>
                                <tr>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $dinner["name"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $dinner["category"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $dinner["description"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <span>&#8358;</span><?php echo $dinner["price_tag"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $dinner["quantity"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold text-dark"> <?php echo $uploaders_name; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold text-dark">
                                        <?php if ($dinner["staff_id"] != null) { ?>
                                            <img src="../public/storage/staff_profileimage/<?php echo $uploaders_image_staff; ?>" alt="" id="users_img" />
                                        <?php } else { ?>
                                            <img src="../public/storage/admin_profileimage/<?php echo $uploaders_image_admin; ?>" alt="" id="users_img" />
                                        <?php } ?>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-view-single-food-data.php?id=<?php echo $dinner["id"]; ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-book-open fa-1x"></i> Info
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-delete-single-food-data.php?id=<?php echo $dinner["id"]; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i> Delete
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-update-single-food-data.php?id=<?php echo $dinner["id"]; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-sync fa-1x"></i> Update
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>


                <br />


                <!-- DRINKS FRAME -->

                <div class="mb-4 mt-4">
                    <h3 class="text-center font-weight-bold" style="font-family: monospace;"> Drinks Table </h3>
                    <table class="table-hover table-striped container-fluid   mt-3 mb-4   ml-0 text-center  bg-white shadow-lg" id="drinks">
                        <thead>
                            <tr>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Category </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Description </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Price </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Quantity </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Name </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class='fa fa-image fa-1x'></i> </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> View </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Delete </th>
                                <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> Update </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $drinksFood = new Food();
                            $drinksmeals = $dinnerFood->selectAllDrinksMeals();

                            foreach ($drinksmeals as $drinks) {
                                if ($drinks["staff_id"] != null) {
                                    $uploader = new Staff();
                                    $uploaders_details = $uploader->selectOneStaffInfo($drinks["staff_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_staff = $uploaders_details["profileimage"];
                                } else {
                                    $uploader = new Admin();
                                    $uploaders_details = $uploader->selectOneAdminInfo($drinks["admin_id"]);

                                    $uploaders_role = $uploaders_details["role"];
                                    $uploaders_name = $uploaders_details["name"];
                                    $uploaders_image_admin = $uploaders_details["profileimage"];
                                }
                            ?>
                                <tr>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $drinks["name"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $drinks["category"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $drinks["description"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <span>&#8358;</span><?php echo $drinks["price_tag"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $drinks["quantity"]; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold"> <?php echo $uploaders_name; ?> </td>
                                    <td class="p-2 m-2 font-weight-bold">
                                        <?php if ($drinks["staff_id"] != null) { ?>
                                            <img src="../public/storage/staff_profileimage/<?php echo $uploaders_image_staff; ?>" alt="" id="users_img" />
                                        <?php } else { ?>
                                            <img src="../public/storage/admin_profileimage/<?php echo $uploaders_image_admin; ?>" alt="" id="users_img" />
                                        <?php } ?>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-view-single-food-data.php?id=<?php echo $drinks["id"]; ?>" class="btn btn-info btn-sm">
                                            <i class="fa fa-book-open fa-1x"></i> Info
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-delete-single-food-data.php?id=<?php echo $drinks["id"]; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa fa-times fa-1x"></i> Delete
                                        </a>
                                    </td>
                                    <td class="m-2 font-weight-bold">
                                        <a href="food-update-single-food-data.php?id=<?php echo $drinks["id"]; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa fa-sync fa-1x"></i> Update
                                        </a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                </div>


                <div class="footer mt-3 mb-3">
                    <h2 class="text-center text-secondary" style="font-family: monospace;">
                        <i class="fa fa-cookie-bite fa-1x"></i> Saucie Enterprise
                    </h2>
                    <p class="text-dark text-center" style="font-size: 16px;">
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved
                    </p>
                </div>
            </div>
        </div>

        <script src="../public/scripts/jquery-3.3.1.js"></script>
        <script src="../public/js/bootstrap.bundle.min.js"></script>
        <script src="../public/fontawesome/js/all.js"> </script>

        <script src="../public/js/staff-main.js"> </script>
</body>

</html>