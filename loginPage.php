<?php

  // Logs in user when form is submitted.
  session_start();
  require("classes/classLoginData.php");
  $data = new LoginData();
?>

<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags. -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS. -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

  <!-- Including style.css. -->
  <link rel="stylesheet" href="css/style.css">

  <title>Login/Sign Up</title>

  <!-- Including bootstrap icon for password toggle. -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body class="bg-image bg-dark">
  <div class="login-main">
    <div class="login-main--container container-shrimp blur-container">
      <form method="post" action="loginPage.php">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="loginEmail" required>
          </div>
          
        </div>
        <div class="form-group row">
          <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
          <div class="col-sm-10">
            <input type="password" class="form-control" id="inputPassword3" name="loginPass" placeholder="Password" required>
            <i class="bi bi-eye-slash" id="togglePasswordLogin"></i>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <button type="submit" name="loginSubmit" class="btn btn-primary">Sign in</button>
            <span>Dont have account?</span>
            <a href="signUpPage.php" class="signup-button"><u>Sign Up</u></a>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <a href="forgotPass.php" class="forgot-button"><u>Forgot Password?</u></a>
          </div>
        </div>
        <span class="red"><?php echo "{$data->message}"; ?></span>
      </form>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  // Change toggle icon and type on click.
  $("#togglePasswordLogin").on("click", function() {
    $(this).toggleClass("bi-eye");
    var password = $('#inputPassword3');
    var type = password.attr('type') === "password" ? "text" : "password";
    $('#inputPassword3').attr('type', type);
  });
</script>

</html>
