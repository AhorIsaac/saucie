<?php
session_start();

function __auloload($Class)
{
    require_once("../classes/$Class.php");
}

require_once("../classes/Food.php");


// function that checks if html input is empty
function checkIfEmpty($inputName)
{
    if (empty($inputName)) {
        session_start();
        $_SESSION['products_update_error'] =
            '<div class="alert alert-danger text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
                <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                <h5 class="alert-heading"> An Error Occurred! </h5>
                <p class=""> All input entries are required. <br />
                Login failed due to submission of an empty input entry! </p>
            </div>';
        header("location: food-update-single-food-data.php");
        // exit();                            
    } else {
        return $inputName;
    }
}


if (isset($_POST["update_food"])) {

    if (isset($_POST["admin_id"])) {
        $admin_id = $_POST["admin_id"];
    } else {
        $admin_id = null;
    }

    if (isset($_POST["staff_id"])) {
        $staff_id = $_POST["staff_id"];
    } else {
        $staff_id = null;
    }

    $food_id = $_POST["food_id"];

    $name = $_POST["food_name"];
    $category = $_POST["food_category"];
    $description = $_POST["food_description"];
    $price_tag = $_POST["food_price_tag"];
    $quantity = $_POST["food_quantity"];

    $image = time() . '_' . $_FILES['food_image']['name'];

    $image = checkIfEmpty($image);

    $target_dir = "uploaded_food/";
    $target_file = $target_dir . basename($_FILES['food_image']['name']);
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $fields1 = [
        "admin_id" => $admin_id,
        "name" => $name,
        "category" => $category,
        "description" => $description,
        "price_tag" => $price_tag,
        "quantity" => $quantity,
        "image" => $image
    ];

    $fields2 = [
        "staff_id" => $staff_id,
        "name" => $name,
        "category" => $category,
        "description" => $description,
        "price_tag" => $price_tag,
        "quantity" => $quantity,
        "image" => $image
    ];

    if (isset($_POST["admin_id"])) {
        move_uploaded_file($_FILES['food_image']['tmp_name'], $target_dir . $image);
        $food = new Food();
        $foodUpdate = $food->updateFoodByAdmin($fields1, $food_id);
        if ($foodUpdate === TRUE) {
            session_start();
            $_SESSION['products_update_success'] =
                '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
                    <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading"> Update Successful! </h5>
                    <p class=""> Saucie Product Successfully Updated </p>
                </div>';
            header("location: food-homepage.php");
            exit();
        }
    }



    if (isset($_POST["staff_id"])) {
        move_uploaded_file($_FILES['food_image']['tmp_name'], $target_dir . $image);
        $food = new Food();
        $foodUpdate = $food->updateFoodByStaff($fields2, $food_id);
        if ($foodUpdate === TRUE) {
            session_start();
            $_SESSION['products_update_success'] =
                '<div class="alert alert-success text-center alert-dismissible fade show " style="font-family: monospace; font-size: 14px; display: inline-block;">
                    <button class="close" data-dismiss="alert"> <span aria-hidden="true">&times;</span> </button>
                    <h5 class="alert-heading"> Update Successful! </h5>
                    <p class=""> Saucie Product Successfully Updated </p>
                </div>';
            header("location: food-homepage.php");
            exit();
        }
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
    <link href="../public/fontawesome/css/all.css" type="text/css" rel="stylesheet">
    <link href="../public/logo.png" rel="icon">
    <style>
        input[type="number"],
        input[type="file"],
        input[type="email"],
        input[type="text"],
        select {
            border: 1px solid dimgray;
            font-family: monospace;
            font-weight: bold;
        }

        body {
            font-family: monospace;
        }

        input[type="text"],
        input[type="email"],
        input[type="file"],
        select,
        a {
            border: 1px solid dimgray;
            font-family: monospace;
            font-weight: bold;
        }

        textarea {
            border: 4px solid dimgray;
            opacity: 0.9;
            border-radius: 8px;
            font-size: 30px;
        }

        #food_frame {
            border: 1px solid antiquewhite;
            font-family: monospace;
            font-weight: bold;
        }

        #msg {
            border: 1px solid dimgray;
            border-radius: 15px;
        }

        a[class="btn"],
        input[type="submit"],
        input[type="reset"] {
            font-weight: bold;
            font-family: "Ubuntu Mono";
        }

        #food_img {
            width: 260px;
            height: 180px;
            border-radius: 5px;
            border: 1px solid antiquewhite;
        }
    </style>
</head>

<body>
    <div class="container pt-3 mt-3">
        <header class="text-center m-3 p-3">
            <h2 class="text-dark" style="font-size: 45px;">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h2>
        </header <?php
                    $id = $_GET["id"];
                    $food = new Food();
                    $foodData = $food->selectOneFoodInfo($id);
                    ?> <div class="text-center">
        <?php if (isset($_SESSION['products_update_error'])) {
            echo $_SESSION['products_update_error'];
            unset($_SESSION['products_update_error']);
        } ?>
    </div>

    <div class="row justify-content-around">

        <div class="col-md-9 bg-white shadow-lg jumbotron" id="food_frame">

            <form method="POST" enctype="multipart/form-data">

                <div class="text-center">
                    <img src="../public/storage/uploaded_food/<?php echo $foodData["image"]; ?>" alt="" id="food_img" />
                </div>

                <h4 class="text-center mt-2 mb-4  text-dark"> Update Saucie Products </h4>

                <div class="form-group row">
                    <label for="adminName" class="col-sm-3 col-form-label">
                        <i class="fa fa-user fa-1x"></i>
                        <?php if (isset($_SESSION["admin_name"])) {
                            echo "Admin ID";
                        } ?>
                        <?php if (isset($_SESSION["staff_name"])) {
                            echo "Staff ID";
                        } ?>
                    </label>
                    <div class="col-sm-7">
                        <?php if (isset($_SESSION["admin_name"])) { ?>
                            <input type="text" class="form-control" name="admin_id" value="<?php echo $_SESSION["admin_id"]; ?>" />
                        <?php } ?>
                        <?php if (isset($_SESSION["staff_name"])) { ?>
                            <input type="text" class="form-control" name="staff_id" value="<?php echo $_SESSION["staff_id"]; ?>" />
                        <?php } ?>

                    </div>
                </div>


                <input type="hidden" name="food_id" value="<?php echo $id; ?>">

                <div class="form-group row">
                    <label for="foodName" class="col-sm-3 col-form-label">
                        Name
                    </label>
                    <div class="col-sm-7">
                        <input type="text" class="form-control" name="food_name" placeholder="Input Food Name" value="<?php echo $foodData["name"]; ?>" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foodCategory" class="col-sm-3 col-form-label">
                        Category
                    </label>
                    <div class="col-sm-7">
                        <select class="form-control" name="food_category">
                            <option value="Breakfast" selected> Breakfast </option>
                            <option value="Lunch"> Lunch </option>
                            <option value="Dinner"> Dinner </option>
                            <option value="Drinks"> Drinks </option>
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foodDescription" class="col-sm-3 col-form-label">
                        Description
                    </label>
                    <div class="col-sm-7">
                        <textarea class="form-control" name="food_description" rows="5" cols="50" id="msg" placeholder="Saucie food description" value="<?php echo $foodData["description"]; ?>" required>
                              </textarea>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="foodPriceTag" class="col-sm-3 col-form-label">
                        Price Tag
                    </label>
                    <div class="col-sm-7 input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text font-weight-bold" id="basic-addon1">&#8358;</span>
                        </div>
                        <input type="text" class="form-control" placeholder="Input amount" aria-label="Username" aria-describedby="basic-addon1" name="food_price_tag">
                    </div>
                </div>


                <div class="form-group row">
                    <label for="foodName" class="col-sm-3 col-form-label">
                        Quantity
                    </label>
                    <div class="col-sm-7">
                        <input type="number" class="form-control" name="food_quantity" placeholder="Input Food Quantity" value="<?php echo $foodData["name"]; ?>" required>
                    </div>
                </div>


                <div class="form-group row">
                    <label for="tutFile" class="col-sm-3 col-form-label">
                        Food <i class="fa fa-image fa-1x"></i>
                    </label>
                    <div class="col-sm-7">
                        <input type="file" class="form-control" name="food_image" placeholder="Select Image" accept="image/*" required>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="buttons" class="col-sm-3 col-form-label"></label>
                    <div class="col-sm-7">
                        <input type="reset" class="btn btn-md font-weight-bold btn-primary text-dark" value="Reset" />
                        <input type="submit" name="update_food" class="btn btn-success text-dark btn-md" value="Upload Product" />

                        <?php if (isset($_SESSION["admin_id"])) { ?>
                            <a href="food-homepage.php" class="btn btn-secondary btn-md text-dark"> Return </a>
                        <?php } ?>

                        <?php if (isset($_SESSION["staff_id"])) { ?>
                            <a href="food-homepage.php" class="btn btn-secondary btn-md text-dark"> Return </a>
                        <?php } ?>
                    </div>
                </div>

            </form>
        </div>
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

</body>

</html>