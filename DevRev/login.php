
<!DOCTYPE html>
<html>
<head>    
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel='stylesheet' href="css/login.css" >
    <script type="text/javascript" src="js/login.js"></script>
    <style>
      body{
    background-image: url("css/3.jpg");
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    background-repeat: no-repeat;

}
  .error {
    color: red;
  }
</style>
<title>Login</title>

</head>
<?php

$users = array();
$csvFile = 'users.csv';
$csvData = file_get_contents($csvFile);
$users = array_map("str_getcsv", explode("\n", $csvData));


?>
<link rel='stylesheet' href="css/login.css" >
<?php

$users = array();
$csvFile = 'users.csv';
$csvData = file_get_contents($csvFile);
$users = array_map("str_getcsv", explode("\n", $csvData));

session_start();
$error = array();

if(isset($_POST["submit"])) { 
  $Email = $_POST["email"];
  $Password = md5($_POST["psw"]);

  $valid_login = false;
  foreach ($users as $user) {
    if (isset($user[2]) && $user[2] == $Password && $user[1] == $Email) {
      $valid_login = true;
      break;
    }
  }

  if($valid_login) {
    $_SESSION['user_id'] = $Email;
    if($Email == 'admin@gmail.com'){
      header('location:admin.html');
      exit;
    }
    header('location:home.html');
    exit;
  }
  else {
    $error[] = 'Incorrect email or password';  
  }
}

?>
<body>
    <div class="box">
        <div class="container">      
          <div class="top">
            <header>Login</header>
          </div>      
          <form method="post" onsubmit="return validateForm()" action="login.php">
            <div class="input-field">
              <input type="text" class="input" placeholder="Email" name="email" id="email">
              <i class='bx bx-user' ></i>
            </div>      
            <div class="input-field">
              <input type="password" class="input" placeholder="Password" name="psw" id="psw">
              <i class='bx bx-lock-alt'></i>
            </div>      
            <div class="input-field">
              <input type="submit" class="submit" value="Login" name="submit" id="submit">
            </div>      
          </form>
              <div class="two-col">
        <div class="one">
          <label><a href="#">Forgot password?</a></label>
        </div>
        <div class="two">
          <span>Haven't an account? <a href="register1.php">sign up</a></span>
        </div>
      </div>   
<div>   
<p>Login with admin username to add books.</p>
<p>username:admin@gmail.com</p>
<p>password : admin@123 </p>
</div>
      
      
    </div>
</div> 

 </body>


<?php
          if(!empty($error)) {
            echo "<div class='error'>";
            foreach($error as $err) {
              echo "<p>".$err."</p>";
            }
            echo "</div>";
          }
          ?>
</html>