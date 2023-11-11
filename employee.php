<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>

<?php
    require('config/config.php');
    require('config/db.php');

    //define total number of results you want per page
    $result_per_page = 30;

    //find the total number of results/rows stored in the database
    $query = "SELECT * FROM employee";
    $result = mysqli_query($conn, $query);
    $number_of_result = mysqli_num_rows($result);

    //determine the total number of pages available
    $number_of_page = ceil($number_of_result / $result_per_page);

    //determine which page number visitor is currently on
    if(!isset($_GET['page'])){
        $page = 1;
    }else{
        $page = $_GET['page'];
    }

    //determine the sql LIMIT starting the number for the results on the display page
    $page_first_result = ($page-1) * $result_per_page;

    //Create Query
    $query = 'SELECT employee.lastname, employee.firstname, employee.address, office.name as office_name FROM employee, office WHERE employee.office_id = office.id LIMIT '. $page_first_result . ',' . $result_per_page;

    //Get the result
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    //Fetch the data
    $employees = mysqli_fetch_all($result, MYSQLI_ASSOC);
    
    //Free result
    mysqli_free_result($result);
    //Close the connection
    mysqli_close($conn);
?>


    <div class="wrapper">
        <div class="sidebar" data-image="assets/img/sidebar-5.jpg">
            
            <div class="sidebar-wrapper">
                <?php include("includes/sidebar.php"); ?>

        <div class="main-panel">
        <?php include("includes/navbar.php"); ?>

            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                    <div class="row">
                    <div class="col-md-12">
                        <div class="striped-table-with-hover">
                        <br/>
                        <div class="col-md-12">
                            <a href="employee-add.php">
                            <button type="submit" class="btn btn-info btn-fill pull-right">Add New Employee</button>
                            </a>
                        </div>
                            <div class="header">
                                <h4 class="title">Employees</h4>
                                <p class="category">Display list of Employees</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <th>Last Name</th>
                                    	<th>First Name</th>
                                    	<th>Address</th>
                                    	<th>Office</th>
                                    </thead>
                                    <tbody>
                                        <?php foreach($employees as $employee): ?>
                                        <tr>
                                        	<td><?php echo $employee['lastname']; ?></td>
                                        	<td><?php echo $employee['firstname']; ?></td>
                                        	<td><?php echo $employee['address']; ?></td>
                                        	<td><?php echo $employee['office_name']; ?></td>
                                        </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                    <?php
                        for($page=1; $page <= $number_of_page; $page++){
                            echo '<a href="transaction.php?page=' . $page . '" style="margin-right: 15px;">' . $page . '</a>';
                        }
                    ?>
                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>

</body>
<!--   Core JS Files   -->
<script src="assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="assets/js/demo.js"></script>

</html>
