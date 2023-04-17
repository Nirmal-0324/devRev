<!DOCTYPE html>
<html>
<head>
  <link rel='stylesheet' href='css/register.css'>
  <title>Sign Up</title>
</head>
<?php
$csvFile = 'users.csv';
$csvData = file_get_contents($csvFile);
$users = array_map("str_getcsv", explode("\n", $csvData));

$error = array();

if (isset($_POST["submit"])) {
  $Name = $_POST["name"];
  $Email = $_POST["email"];
  $Password = md5($_POST["psw"]);
  $ConfirmPassword = md5($_POST["psw-confirm"]);

  if ($Password != $ConfirmPassword) {
    $error[] = 'Password and Confirm Password do not match!';
  }

  $userExists = false;
  foreach ($users as $user) {
    if (count($user) >= 2 && $user[1] == $Email) {
      $userExists = true;
      break;
    }
  }
  

  if ($userExists) {
    $error[] = 'User already exists!';
  }

  if (count($error) == 0) {
    $newUser = array($Name, $Email, $Password);
    $users[] = $newUser;
    $fp = fopen('users.csv', 'w');
    foreach ($users as $user) {
      fputcsv($fp, $user);
    }
    fclose($fp);
    header('location:login.php');
  }
}
?>


<body>   
<div class="align">
  <h2 style="text-align:center;">Sign Up</h2>
  <form action="" method="post" onsubmit="return validateForm()">
    <div class="container">
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Enter Name" name="name" required>

      <label for="email"><b>Email</b></label>
      <input type="email" placeholder="Enter Email" name="email" required>

      <label for="psw"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="psw" id="passwordInput" required>

      <label for="psw-confirm"><b>Confirm Password</b></label>
      <input type="password" placeholder="Confirm Password" name="psw-confirm" id="confirmPasswordInput" required>

      <?php if(isset($_POST["submit"]) && count($error)>0 && isset($error)){ ?>
        <p id="error-msg" style="color:red"><?php echo implode("<br>", $error); ?></p>
      <?php } ?>

      <button type="submit" name="submit">Sign Up</button>
      
      <?php if(isset($_POST["submit"]) && count($error) == 0){ ?>
        <p id="signup-msg" style="color:green">Sign Up successful! Please login.</p>
      <?php } ?>
      
    </div>
    <div class="login">
      <p>
        Already have an account?
        <a href="login.php">Log in</a>
      </p>
    </div>
  </form>
</div>
</body>


</html>
