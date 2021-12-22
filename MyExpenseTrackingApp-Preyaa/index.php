<?php
/*the php file session has been imported in the index.php fle */
  include("session.php");

  /*after selecting some expense categories from the database, the sum is shown in the graph */
  $exp_category_dc = mysqli_query($con, "SELECT expensecategory FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  $exp_amt_dc = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensecategory");
  
  /*Items bought on the same date are added together in the graphs */
  $exp_date_line = mysqli_query($con, "SELECT expensedate FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
  $exp_amt_line = mysqli_query($con, "SELECT SUM(expense) FROM expenses WHERE user_id = '$userid' GROUP BY expensedate");
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=5, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>My Dashboard</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href = "css/style.css" rel="stylesheet"/>

  <!-- Feather JS for Icons -->
  <script src="js/feather.min.js"></script>
  <style>
     body {
      color: #000;
      background: linear-gradient(90deg, #FDBB2D 0%, #3A1C71 100%);
      font-family: 'Roboto', sans-serif;
     }

    .card a {
      color: #e81c9d;
      font-weight: 300;
    }

    .card a:hover {
      color: #ffcb0d;
      text-decoration: dotted;
    }
  </style>
}

</head>

<body>

  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="border-left" id="sidebar-wrapper">
      <div class="user">

      <!-- size of profile picture -->
        <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="100">
        <!--The Name of the user is displayed on top of the MENU BAR on the left hand side-->
        <h5><?php echo $username ?></h5>

        <!--The Email Address of the user is displayed on top of the MENU BAR on the left hand side-->
        <p><?php echo $useremail ?></p>
      </div>
      <div class="sidebar-heading">EXPENSE MANAGEMENT</div>
      <div class="list-group list-group-flush">
        <a href="index.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="home"></span><b> Dashboard</b></a>
        <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus"></span><b> Add your Expenses</b></a>
        <a href="manage_expense.php" class="list-group-item list-group-item-action "><span data-feather="file-text"></span><b> Manage your Expenses</b></a>
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
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="100">
              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

              <!-- Here the user will be directed to the user profile page -->
                <a class="dropdown-item" href="profile.php">Your Profile</a>
                <div class="dropdown-divider"></div>

              <!-- Here the user will be directed to the Welcome page after signing out-->
                <a class="dropdown-item" href="logout.php">Logout</a>
              </div>
            </li>
          </ul>
        </div>
      </nav>

      <div class="container-fluid">
        <!--This is the title of my dahboard -->
        <h1 class="mt-4"><b>Welcome to My Dashboard</b></h1>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-body">
                <div class="row">

                <!-- the headings are positioned in the center-->
                  <div class="col text-center">

                  <!--the width of all the icons in the dashboard are 60px-->
                    <a href="add_expense.php"><img src="dashboardicons/additem.jpg" width="60px" />
                      <p>Add Items</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="manage_expense.php"><img src="dashboardicons/expenses.jpg" width="60px" />
                      <p>Manage Expenses</p>
                    </a>
                  </div>
                  <div class="col text-center">
                    <a href="profile.php"><img src="dashboardicons/profile.jpg" width="60px" />
                      <p>My Profile</p>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <h3 class="mt-4">CHARTS</h3>
        <div class="row">
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-left">Annual Expenses</h5>
              </div>
              <div class="card-body">

              <!--The height of both charts are 150-->
                <canvas id="expense_line" height="150"></canvas>
              </div>
            </div>
          </div>
          <div class="col-md">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title text-left">Expense Category</h5>
              </div>
              <div class="card-body">
                <canvas id="expense_category_pie" height="150"></canvas>
              </div>
            </div>
          </div>
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
  <script>
    var ctx = document.getElementById('expense_category_pie').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: [<?php while ($a = mysqli_fetch_array($exp_category_dc)) {
                    echo '"' . $a['expensecategory'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Category',
          data: [<?php while ($b = mysqli_fetch_array($exp_amt_dc)) {
                    echo '"' . $b['SUM(expense)'] . '",';
                  } ?>],
          backgroundColor: [
            '#fce4ec',
            '#ffcdd2',
            '#f8bbd0',
            '#f48fb1',
            '#f06292',
            '#e91e63',
            '#c2185b',
            '#880e4f',
            '#f50057',
            '#c51162'
          ],
          borderWidth: 1
        }]
      }
    });

    var line = document.getElementById('expense_line').getContext('2d');
    var myChart = new Chart(line, {
      type: 'line',
      data: {
        labels: [<?php while ($c = mysqli_fetch_array($exp_date_line)) {
                    echo '"' . $c['expensedate'] . '",';
                  } ?>],
        datasets: [{
          label: 'Expense by Month (Whole Year)',
          data: [<?php while ($d = mysqli_fetch_array($exp_amt_line)) {
                    echo '"' . $d['SUM(expense)'] . '",';
                  } ?>],
          borderColor: [
            '#adb5bd'
          ],
          backgroundColor: [
            '#fce4ec',
            '#ffcdd2',
            '#f8bbd0',
            '#f48fb1',
            '#f06292',
            '#e91e63',
            '#c2185b',
            '#880e4f',
            '#f50057',
            '#c51162'
          ],
          fill: false,
          borderWidth: 1
        }]
      }
    });
  </script>
</body>

</html>