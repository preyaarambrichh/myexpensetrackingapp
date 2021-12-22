<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="./styles.css">

    <script defer src="./script.js"></script>

    <!-- Google Fonts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lewsiham&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lobster&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Dosis:wght@300;400;500;600&family=Lobster&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Lucida&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Castellar:wght@300;400;500;600;700&display=swap');
        :root {
    --main-title: 'Lobster', cursive;  /* Weights: 400 */
    --text: 'lewisham', cursive;  /* Weights: 400 */  
    --qoute-text: 'lucida', cursive; /* Weights: 400 */
    --main-text: 'castellar', cursive; /* Weights: 300, 400, 500, 600, 700 */
 
}

* {
    margin: 2;
    padding: 0;
    box-sizing: border-box;
}

/* whole page background color in gradient */
body {
    height: 125vh;
    background: rgb(23,255,209);
    background: linear-gradient(0deg, rgba(23,255,209,1) 44%, rgba(255,229,82,1) 68%, rgba(252,226,23,1) 100%);
}

main {
    position: absolute;
    top: 15%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: grid;
    place-items: center;
    gap: 1.8rem;
}

h1 {
    font-family: var(--main-title);
    font-weight: 500;
    font-size: 3.5em;
    text-align: center;
    color: hsl(342, 94%, 43%);
    animation: title 4s forwards;
}

@keyframes title {
    from {opacity: 0%; font-size: 0;}
    to {opacity: 100%; font-size: 3.5;}
}

br {
    display: none;
}

small {
    font-family: var(--text);
    font-weight: 400;
    font-size: 1.9em;
    color: hsl(177, 94%, 28%);
    animation: welcome 3s forwards;
}

@keyframes welcome {
    from {opacity: 0%;}
    to {opacity: 100%;}
}

p {
    font-family: var(--qoute-text);
    font-size: 1.2em; 
    text-align: center;
}

footer {
    position: absolute;
    top: 90%;
    left: 50%;
    transform: translate(-50%, -50%);
}

a {
   margin: 12px;
   padding: 15px 45px;
   text-align: center;
   text-transform: uppercase;
   text-decoration: none;
   font-family: var(--main-text);
   transition: 0.5s;
   background-size: 200% auto;
   color: white;            
   box-shadow: 0 0 10px #eee;
   border: 1px solid transparent;
   border-radius: 20px;
   display: block;
   cursor: pointer;
   animation: ancher 4s forwards;
   background-image: linear-gradient(
    to right, #c70c76 0%, #e7ff2e 51%, #16A085 100%
    )
 }

a:hover {
   background-position: right center;
   color: hsl(208, 12%, 10%);
   text-decoration: none;
}

@keyframes ancher {
    0% {opacity: 0%;}
    90% {opacity: 0%;}
    100% {opacity: 100%;}
}


@media screen and (max-width: 1024px) {
    main {
        width: 80vw;
    }

    p {
        width: 80%;
        margin: 0 auto;
    }

    br {
        display: block;
    }
}
    </style>



    <title>Welcome Page</title>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 220">
        <path fill="rgba(210,193,72,.7)" fill-opacity="1" d="M0,224L0,96L120,96L120,32L240,32L240,256L360,256L360,96L480,96L480,96L600,96L600,192L720,192L720,192L840,192L840,32L960,32L960,160L1080,160L1080,224L1200,224L1200,128L1320,128L1320,192L1440,192L1440,0L1320,0L1320,0L1200,0L1200,0L1080,0L1080,0L960,0L960,0L840,0L840,0L720,0L720,0L600,0L600,0L480,0L480,0L360,0L360,0L240,0L240,0L120,0L120,0L0,0L0,0Z"></path>
    </svg>
    <main class="welcome-box">
      
        <small class="welcome-text">Welcome to</small>
        <h1 class="main-text">My Expense<br> Tracking App</h1>
        <blockquote>
            <p>"It is easy to meet expenses, everywhere we go, there they are"</p>
            <p><b>Designed by Preyaa Rambrichh</b></p>
        </blockquote>
    </main>
</body>
</html>

<?php
require('config.php');
session_start();
$errormsg = "";
if (isset($_POST['email'])) {

  $email = stripslashes($_REQUEST['email']);
  $email = mysqli_real_escape_string($con, $email);
  $password = stripslashes($_REQUEST['password']);
  $password = mysqli_real_escape_string($con, $password);
  $query = "SELECT * FROM `users` WHERE email='$email'and password='" . md5($password) . "'";
  $result = mysqli_query($con, $query) or die(mysqli_error($con));
  $rows = mysqli_num_rows($result);
  if ($rows == 1) {
    $_SESSION['email'] = $email;
    header("Location: index.php");
  } else {
    $errormsg  = "Wrong";
  }
} else {
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Login Form</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>

    /* login form size */
    .login-form {
      width: 520px;
      margin: 60px auto;
      font-size: 22px;
    }
    /* login form background color */
    .login-form form {
      margin-bottom: 20px;
      background: linear-gradient(90deg, #fcff9e 0%, #c67700 100%);
      padding: 30px;
      border: 2px solid #10ebad;
    }
    
    /* Format for Expense Tracking App Title */
    .login-form h3 {
      color: #004000;
      margin: 2 2 20px;
      position: absolute;
      text-align: center;
    }

    .login-form h3:before {
      left: 1;
    }

    .login-form h3:after {
      right: 1;
    }
    /* hint text = Sign In */
    .login-form .hint-text {
      color: #ff1755;
      margin-bottom: 30px;
      text-align:center;

    }
    /* Register Here Button format */
    .login-form a:hover {
      background-color: lightsteelblue;
    color: azure;
    }

    /* Login Button Formatting */
    .form-control,
    .btn {
      min-height: 26px;
      border-radius: 5px;
    }
    /* Button Size */
    .btn {
      font-size: 18px;
      font-weight: bold;
    }
  </style>
</head>

<body>
  <div class="login-form">
    <form action="" method="POST" autocomplete="off">
     
      <p class="hint-text"> Sign In Form</p>
      <div class="form-group">
    <!-- Enter your Email Address-->
        <input type="text" name="email" class="form-control" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <!-- Enter your Password-->
        <input type="password" name="password" class="form-control" placeholder="Password" required="required">
      </div>
      <div class="form-group">
    <!-- Click on Login Button if you have already register an account-->
        <button type="submit" class="btn btn-success btn-block" style="border-radius:0%;">Login Now</button>
      </div>
      <div class="clearfix">
    <!-- Click on 'Remember me' to remember my credentials-->
        <label class="float-none form-check-label"><input type="checkbox"> Remember me</label>
        
      </div>
    </form>
    <!-- Click on Register Button if you don't have an account-->
    <p class="text-center">You don't have an account?<a href="register.php" class="text-danger"> Register Here</a></p> 
  </div>
</body>
<!-- Bootstrap core JavaScript -->
<script src="js/jquery.slim.min.js"></script>
<script src="js/bootstrap.min.js"></script>
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

</html>