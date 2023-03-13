<?php

  // Registers the user on form submit.
  session_start();
  require("classes/classSignUpData.php");
  $data = new SignUpData();
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

  <title>Registration Page</title>

  <!-- Including bootstrap icon for password toggle. -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    
</head>

<body class="bg-image bg-dark">
  <div class="login-main">
    <div class="login-main--container container-form blur-container">
      <form class="signUpForm m-3" method="post" action="signUpPage.php">
        <div class="form-group">
          <label for="inputFirstName">First Name</label>
          <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" aria-describedby="emailHelp"
          placeholder="Enter First Name" required>
        </div>
        <div class="form-group">
          <label for="inputEmail3">Email</label>
          <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="loginEmail" required>
        </div>
        <div class="form-group password-form-group">
          <label for="inputPassword3">Password</label>
          <input type="password" class="form-control password-field" id="inputPassword3" name="signUpPass" placeholder="Password"
          required>
          <i class="bi bi-eye-slash" id="togglePassword"></i>
          <span class="passWrong red">*Password should be atleast 8 characters long</span>
        </div>
        <div class="form-group">
          <label for="reEnterPassword">Re-enter Password</label>
          <input type="password" class="form-control" id="reEnterPassword" name="reEnterPassword" placeholder="Re-enter Password"
          required>
          <span class="wrong red">*Entered text not same as password.</span>
          <span class="correct green">*Entered text same as password.</span>
        </div>
        <button type="submit" name="signUpSubmit" class="btn btn-primary">Sign Up</button>
        <h5 class="red"><?php echo "{$data->message}"; ?></h5>
      </form>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Change toggle icon and type on click.
    $("#togglePassword").on("click", function() {
      $(this).toggleClass("bi-eye");
      var password = $('.password-field');
      var type = password.attr('type') === "password" ? "text" : "password";
      $('.password-field').attr('type', type);
    });
    // Check strength of password entered.
    $("input[name='signUpPass']").on("input", function() {
      var password = $("input[name='signUpPass']").val();
      if (password.length < 8) {
        $(".passWrong").css("display","flex");
        $(":submit").attr("disabled", TRUE);
      }
      else {
        $(".passWrong").css("display","none");
        $(":submit").attr("disabled", FALSE);
      }
    });
    // Checks entered password and validates.
    $("input[name='signUpPass']").on("input", function() {
      var password = $("input[name='signUpPass']").val();
      var reEnterPassword = $("input[name='reEnterPassword']").val();
      if (password.length == 0) {
        $(".passWrong").css("display","none");
        $(".correct").css("display","none");
      }
      else if (password == reEnterPassword) {
        $(".correct").css("display","flex");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", FALSE);
      }
      else if (reEnterPassword.length > 0 && password.length > 0) {
        $(".correct").css("display","none");
        $(".wrong").css("display","flex");
        $(":submit").attr("disabled", TRUE);
      }
      else {
        $(".correct").css("display","none");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", TRUE);
      }
    });
    // Checks re-entered password and validates.
    $("input[name='reEnterPassword']").on("input", function() {
      var password = $("input[name='signUpPass']").val();
      var reEnterPassword = $("input[name='reEnterPassword']").val();
      if (reEnterPassword.length == 0 && password.length == 0) {
        $(".wrong").css("display","none");
        $(".correct").css("display","none");
        $(".passWrong").css("display","none");
      }
      else if (password == reEnterPassword) {
        $(".correct").css("display","flex");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", FALSE);
      }
      else if (password.length >= 0 && reEnterPassword.length > 0) {
        $(".correct").css("display","none");
        $(".wrong").css("display","flex");
        $(":submit").attr("disabled", TRUE);
      }
      else {
        $(".correct").css("display","none");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", TRUE);
      }
    });
  });
</script>

</html>
