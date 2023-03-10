<?php

  // Validate the token and get the email address associated with the token.
  require("classes/classForgotPass.php");
  $data = new ForgotPass();
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

  <title>Forgot Password Form</title>

  <!-- Including bootstrap icon for password toggle. -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
</head>

<body class="bg-image bg-dark">
  <div class="login-main">
    <div class="login-main--container container-form blur-container">
      <form class="forgotForm m-3" method="post" action="forgotForm.php?token=<?php echo $_GET['token']; ?>">
        <div class="form-group">
          <label for="inputPassword3">New Password</label>
          <input type="password" class="form-control new-password" id="inputPassword3" name="forgotFormPass" placeholder="New Password"
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
        <button type="submit" name="forgotFormSubmit" class="btn btn-primary">Submit</button>
      </form>
      <?php echo $data->message; ?>
    </div>
  </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
  $(document).ready(function() {
    // Change toggle icon and type on click.
    $("#togglePassword").on("click", function() {
      $(this).toggleClass("bi-eye");
      var password = $('.new-password');
      var type = password.attr('type') === "password" ? "text" : "password";
      $('.new-password').attr('type', type);
    });
    // Check strength of password entered.
    $("input[name='forgotFormPass']").on("input", function() {
      var password = $("input[name='forgotFormPass']").val();
      if (password.length < 8) {
        $(".passWrong").css("display","flex");
        $(":submit").attr("disabled", true);
      }
      else {
        $(".passWrong").css("display","none");
        $(":submit").attr("disabled", false);
      }
    });
    // Checks entered password and validates.
    $("input[name='forgotFormPass']").on("input", function() {
      var password = $("input[name='forgotFormPass']").val();
      var reEnterPassword = $("input[name='reEnterPassword']").val();
      if (password.length == 0) {
        $(".passWrong").css("display","none");
        $(".correct").css("display","none");
      }
      else if (password == reEnterPassword) {
        $(".correct").css("display","flex");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", false);
      }
      else if (reEnterPassword.length > 0 && password.length > 0) {
        $(".correct").css("display","none");
        $(".wrong").css("display","flex");
        $(":submit").attr("disabled", true);
      }
      else {
        $(".correct").css("display","none");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", true);
      }
    });
    // Checks re-entered password and validates.
    $("input[name='reEnterPassword']").on("input", function() {
      var password = $("input[name='forgotFormPass']").val();
      var reEnterPassword = $("input[name='reEnterPassword']").val();
      if (reEnterPassword.length == 0 && password.length == 0) {
        $(".wrong").css("display","none");
        $(".correct").css("display","none");
        $(".passWrong").css("display","none");
      }
      else if (password == reEnterPassword) {
        $(".correct").css("display","flex");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", false);
      }
      else if (password.length >= 0 && reEnterPassword.length > 0) {
        $(".correct").css("display","none");
        $(".wrong").css("display","flex");
        $(":submit").attr("disabled", true);
      }
      else {
        $(".correct").css("display","none");
        $(".wrong").css("display","none");
        $(":submit").attr("disabled", true);
      }
    });
  });
</script>

</html>
