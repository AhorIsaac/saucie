<?php
session_start();

function __autoload($Class)
{
    require_once("../classes/$Class.php");
}

if (!($_SESSION["admin_id"])) {
    header('location: users-login.php');
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

        #customer_table h3 {
            color: white;
        }

        #customer_table p {
            font-size: 20px;
            color: black;
        }

        #users_img {
            width: 80px;
            height: 80px;
            border-radius: 40px;
        }

        th {
            color: black;
            font-size: 15px;
        }

        td {
            color: black;
        }

        #customer_table {
            border: 1px solid orange;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <header class="text-center pt-3">
            <h1 class="text-center mt-4 mb-4">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h1>
        </header>

        <h3 class="text-center"> View All Customers Page </h3>


        <!-- CUSTOMERS TABLE FRAME -->

        <div class="mt-4 mb-4">
            <table class="table-hover table-striped  ml-0 text-center shadow-lg bg-white w-sm-100" id="customer_table">
                <thead class="mt-3 mb-3">
                    <tr class="pb-3 pt-3 mt-3 mb-3">
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-user-circle fa-1x"></i> Name </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-envelope fa-1x"></i> Email </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-phone fa-1x"></i> Telephone </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-address-card fa-1x"></i> Address </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-check-circle fa-1x"></i> Status </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-3 pr-3"> <i class="fa fa-image fa-1x"></i> Profile </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $customer = new Customer();
                    $customers = $customer->selectAllCustomers();

                    foreach ($customers as $cus) {

                    ?>
                        <tr>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $cus["name"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $cus["email"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $cus["telephone"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $cus["address"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold">
                                <?php
                                if ($cus["status"] == 1) {
                                    echo 'Active';
                                } else {
                                    echo 'Inactive';
                                }
                                ?>
                            </td>
                            <td class="p-2 m-2 font-weight-bold">
                                <img src="../public/storage/customer_profileimage/<?php echo $cus["profileimage"]; ?>" alt="" id="users_img" />
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="text-center mt-4 mb-4">
                <a href="admin-homepage.php" class="btn btn-outline-info btn-md">
                    Return to Admin Homepage
                </a>
            </div>
        </div>


        <footer class="text-center mt-3 mb-3">
            <h3 class="text-center">
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