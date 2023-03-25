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
        #staff_table h3 {
            color: white;
        }

        #staff_table p {
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

        #staff_table {
            border: 1px solid orange;
            border-radius: 20px;
        }
    </style>
</head>

<body class="bg-white">
    <div class="container">
        <header class="text-center pt-3">
            <h1 class="text-center mt-4 mb-4">
                <i class="fa fa-cookie-bite fa-1x"></i> Saucie <br />
            </h1>
        </header>

        <!-- STAFF TABLE FRAME -->

        <div class="">
            <h3 class="text-center font-weight-bold m-3" style="font-family: monospace;"> Staff Table </h3>
            <table class="table-hover table-striped container-fluid ml-0 text-center shadow-lg bg-light w-sm-100" id="staff_table">
                <thead>
                    <tr class="pb-3 pt-3 mt-3 mb-3">
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-id-badge fa-1x"></i> ID </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-user-circle fa-1x"></i> Name </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-check-circle fa-1x"></i> Status </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-image fa-1x"></i> Profile Image </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-book fa-1x"></i> View </th>
                        <th class="font-weight-bold pt-2 pb-2 pl-1 pr-1"> <i class="fa fa-times fa-1x"></i> Delete </th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $employee = new Staff();
                    $employeeStaff = $employee->selectAllStaff();

                    foreach ($employeeStaff as $staff) {

                    ?>
                        <tr>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $staff["id"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold"> <?php echo $staff["name"]; ?> </td>
                            <td class="p-2 m-2 font-weight-bold"> <?php if ($staff["status"] == 1) {
                                                                        echo 'Active';
                                                                    } ?> </td>
                            <td class="p-2 m-2 font-weight-bold">
                                <img src="../public/storage/staff_profileimage/<?php echo $staff["profileimage"]; ?>" alt="" id="users_img" />
                            </td>
                            <td class="m-2 font-weight-bold">
                                <form action="admin-view-single-staff-data.php" method="POST" class="d-inline">
                                    <input type="hidden" name="staff_id" value="<?php echo $staff['id']; ?>" />
                                    <button type="submit" class="btn btn-outline-info btn-sm" name="submit_button">
                                        <i class="fa fa-book-open fa-1x"></i> Info
                                    </button>
                                </form>
                            </td>
                            <td class="m-2 font-weight-bold">
                                <a href="admin-delete-single-staff-data.php?id=<?php echo $staff["id"]; ?>" class="btn btn-danger btn-sm">
                                    <i class="fa fa-times fa-1x"></i> Delete
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="text-center mb-5 mt-5">
                <a href="admin-homepage.php" class="btn btn-outline-info btn-md">
                    Return to Admin Homepage
                </a>
            </div>
        </div>


        <footer class="text-center">
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