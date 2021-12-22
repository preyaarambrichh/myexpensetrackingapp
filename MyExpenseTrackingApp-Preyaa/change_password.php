<?php
include("session.php");
$exp_fetched = mysqli_query($con, "SELECT * FROM expenses WHERE user_id = '$userid'");
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=5, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title of the page that would appear while loading-->
    <title>My Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href = "http://localhost/style_goals.css" rel="stylesheet" type = "text/css"/>

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="100">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>

            <!-- MENU BAR title-->
            <div class="sidebar-heading">EXPENSE MANAGEMENT</div>
            <div class="list-group list-group-flush">

                <!-- Here the user will be directed to the Dashboard page -->
                <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span><b> Dashboard</b></a>
                        
                <!-- Here the user will be directed to the Add Your Expense page -->
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus"></span><b> Add Your Expenses</b></a>
                
                <!-- Here the user will be directed to the Manage Your Expense page -->
                <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="file-text"></span> <b>Manage Your Expenses</b></a>
                
                <!-- Here the user will be redirected to the Welcome Page since he will be logging out -->
                <a href="logout.php" class="list-group-item list-group-item-action "><span data-feather="monitor"></span><b> Sign Out</b></a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Your Profile</a>
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <h5>Hi <?php echo $firstname ?>! You can change your password here</h5>
                <div class="row mt-3">
                    <div class="col-md">
                        <form class="form" action="" method="post" id="registrationForm" autocomplete="off">
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter Current Password
                                    </label>
                                    <input type="password" class="form-control" name="curr_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col">
                                    <label for="password">
                                        Enter New Password
                                    </label>
                                    <input type="password" class="form-control" name="new_password" id="password" placeholder="New Password">
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="col">
                                    <label for="password2">
                                        Confirm New Password
                                    </label>
                                    <input type="password" class="form-control" name="confirm_new_password" id="confirm_password" placeholder="Confirm My Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <br>
                                    <button class="btn btn-block btn-primary" name="updatepassword" type="submit">Update My Password</button>
                                </div>
                            </div>
                        </form>
                        <!--/tab-content-->

                    </div>
                    <!--/col-9-->
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace()
    </script>

</body>

</html>