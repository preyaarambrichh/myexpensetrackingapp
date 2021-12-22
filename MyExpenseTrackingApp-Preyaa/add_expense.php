<?php
/*the php file session has been imported in the add_expense php fle */
include("session.php");

/*update is set to false */
$update = false; 

/*delete is set to false */
$del = false;

$expenseamount = "";
$expensedate = date("Y-m-d");
$expensecategory = "";

/*when user will click on the ADD button, the price of the item, the date of purchase & expense category will also be recorded*/
if (isset($_POST['add'])) {
    $expenseamount = $_POST['expenseamount']; /*the Amount currency is in Rs*/
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

/*Here the expense data(Amount/Date/Category) are recorded in the database*/
    $expenses = "INSERT INTO expenses (user_id, expense,expensedate,expensecategory) VALUES ('$userid', '$expenseamount','$expensedate','$expensecategory')";
    $result = mysqli_query($con, $expenses) or die("OOPS!Something Went Wrong!");
    header('location: add_expense.php');
}
/*if the user wants to update something in his expense record, he will hit the UPDATE button*/
if (isset($_POST['update'])) {
    $id = $_GET['update'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

/*Here the Updated expense data(Amount/Date/Category) are recorded in the database*/
    $sql = "UPDATE expenses SET expense='$expenseamount', expensedate='$expensedate', expensecategory='$expensecategory' WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {

        /*an ERROR message is displayed if not updated successfully*/
        echo "ERROR: Sorry! Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

/*if the user wants to DELETE something in his expense record, he will hit the DELETE button*/
if (isset($_POST['delete'])) {
    $id = $_GET['delete'];
    $expenseamount = $_POST['expenseamount'];
    $expensedate = $_POST['expensedate'];
    $expensecategory = $_POST['expensecategory'];

/*Here the Updated expense data(Amount/Date/Category) are recorded in the database after a/some record(s) has/have been deleted*/
    $sql = "DELETE FROM expenses WHERE user_id='$userid' AND expense_id='$id'";
    if (mysqli_query($con, $sql)) {
        echo "Records were updated successfully.";
    } else {
        /*an ERROR message is displayed if not updated successfully after deletion*/
        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
    }
    header('location: manage_expense.php');
}

/*Here the user will be able to check and update the data that has been recorded*/
if (isset($_GET['update'])) {
    $id = $_GET['update'];

    /*update is set to TRUE*/
    $update = true;

    /*Here the user will be able to select from the Expense Table which data he wants to update*/
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("UNAUTHORISED ACCESS TO USERS'EXPENSE RECORD");
    }
}

/*Here the user will be able to DELETE the data that has been recorded according to his choice of category*/
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    /* delete is set to TRUE*/
    $del = true;

    /*Here the user will be able to select from the Expense Table which data he wants to Delete*/
    $record = mysqli_query($con, "SELECT * FROM expenses WHERE user_id='$userid' AND expense_id=$id");
    if (mysqli_num_rows($record) == 1) {
        $n = mysqli_fetch_array($record);
        $expenseamount = $n['expense'];
        $expensedate = $n['expensedate'];
        $expensecategory = $n['expensecategory'];
    } else {
        echo ("WARNING!  Trying to Access Unauthorized data");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8"> 
    <meta name="viewport" content="width=device-width, initial-scale=5, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title of the page that would appear while loading-->
    <title>Add Expense</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href = "css/style.css" rel="stylesheet"/>
    
    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">

                <!-- size of profile picture-->
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="100">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Expense Management</div>
            <div class="list-group list-group-flush">
                <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span><b> Dashboard</b></a>
                <a href="add_expense.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="plus"></span><b> Add Your Expenses</b></a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="file-text"></span><b> Manage Your Expenses</b></a>
          
        </div>
       
            <div class="container">
                <h3 class="mt-4 text-center">Add Your Daily Expenses</h3>
                <hr>
                <div class="row ">

                    <div class="col-md-3"></div>

                    <div class="col-md" style="margin:0 auto;">
                        <form action="" method="POST">
                            <div class="form-group row">
                                <label for="expenseamount" class="col-sm-6 col-form-label"><b>Enter Amount(Rs)</b></label>
                                <div class="col-md-6">
                                    <input type="number" class="form-control col-sm-12" value="<?php echo $expenseamount; ?>" id="expenseamount" name="expenseamount" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="expensedate" class="col-sm-6 col-form-label"><b>Date of Purchase</b></label>
                                <div class="col-md-6">
                                    <input type="date" class="form-control col-sm-12" value="<?php echo $expensedate; ?>" name="expensedate" id="expensedate" required>
                                </div>
                            </div>
                            <fieldset class="form-group">
                                <div class="row">
                                    <legend class="col-form-label col-sm-6 pt-0"><b>Category in terms of priority</b></legend>
                                    <div class="col-md">

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory4" value=" UTILITY BILLS(CWA,CEB,Internet Bills)" <?php echo ($expensecategory == ' UTILITY BILLS(CWA,CEB,Internet Bills)') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory4">
                                                UTILITY BILLS <!--Listed as top priority in category -->
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory3" value="Fuel & Petrol" <?php echo ($expensecategory == 'Fuel & Petrol') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory3">
                                                Fuel & Petrol <!--Listed as top priority in category -->
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory2" value="RENT(house/office)" <?php echo ($expensecategory == 'RENT(house/office)' ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory2">
                                                RENT <!--Listed as top priority in category -->
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory1" value="Grocery Shopping" <?php echo ($expensecategory == 'Grocery Shopping') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory1">
                                               Grocery Shopping <!--Listed as top priority in category -->
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory7" value="Lease" <?php echo ($expensecategory == 'Lease') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory7">
                                                Lease <!--Listed as top priority in category -->
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory6" value="GYM Membership" <?php echo ($expensecategory == 'GYM Membership') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory6">
                                                GYM Membership <!--Listed as least prioritise in category -->
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="expensecategory" id="expensecategory8" value="Medical & Healthcare" <?php echo ($expensecategory == 'Medical & Healthcare') ? 'checked' : '' ?>>
                                            <label class="form-check-label" for="expensecategory8">
                                                Medical & Healthcare <!--Listed as least prioritise in category -->
                                            </label>               
                                   </div>
                                </div>
                            </fieldset>
                            <div class="form-group row">
                                <div class="col-md-12 text-right">
                                    <?php if ($update == true) : ?>
                                        <button class="btn btn-lg btn-block btn-warning" style="border-radius: 0%;" type="submit" name="update">Update my expense</button>
                                    <?php elseif ($del == true) : ?>
                                        <button class="btn btn-lg btn-block btn-danger" style="border-radius: 0%;" type="submit" name="delete">Delete my expense</button>
                                    <?php else : ?>
                                        <button type="submit" name="add" class="btn btn-lg btn-block btn-success" style="border-radius: 0%;">Add another expense</button>
                                    <?php endif ?>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-3"></div>
                    
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
        feather.replace();
    </script>
    <script>

    </script>
</body>
</html>