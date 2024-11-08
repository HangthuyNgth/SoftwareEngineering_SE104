<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BMagic School </title>
   
    <!-- plugins:css -->
    <link rel="stylesheet" href="css/vendors/feather/feather.css">
    <link rel="stylesheet" href="css/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="css/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="css/vendors/typicons//typicons.css">
    <link rel="stylesheet" href="css/vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="css/vendors/vendor.bundle.base.css">
    <!-- endinject -->

    <!--plugins:css-boxicons -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="css/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" type="text/css" href="css/vendors/select.dataTables.min.css">
    <link rel="stylesheet" href="css/vendors/vertical-layout-light/style.css">

    <link rel="shortcut icon" href="../Admin/images/favicon.png" />

</head>

<body>
    <!-- kết nối cơ sở dữ liệu -->
    <?php include "../Database/Config/config.php"
    ?>

    <div class="container-scroller">
        <!-- thanh menu ngang -->
        <?php include "partials/navbar.php"; ?>

        <!-- trang chính -->
        <div class="container-fluid page-body-wrapper">
            <!-- thanh menu dọc -->
            <?php include "partials/sidebar.php";  ?>
            <!-- custom panel -->
            <?php include "partials/settings-panel.php"; ?>
            <!-- Nội dung trang -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <?php include "pages/section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <!-- plugins:js -->
    <script src="js/vendors/vendor.bundle.base.js"></script>
    <script src="js/vendors/bootstrap-datepicker.min.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="js/vendors/Chart.min.js"></script>
    <script src="js/vendors/progressbar.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/vendors/off-canvas.js"></script>
    <script src="js/vendors/hoverable-collapse.js"></script>
    <script src="js/vendors/template.js"></script>
    <script src="js/vendors/settings.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/vendors/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/vendors/dashboard.js"></script>
    <!-- End custom js for this page-->
</body>

</html>