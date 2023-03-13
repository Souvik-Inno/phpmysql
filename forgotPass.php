<?php

  // Sends mail to email when form is submitted.
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

  <title>Forgot Password</title>
</head>

<body class="bg-image bg-dark">
  <div class="forgot-main">
    <div class="forgot-main--container container-shrimp blur-container">
      <form class="forgot-form" method="post" action="forgotPass.php">
        <div class="form-group row">
          <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
          <div class="col-sm-10">
            <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="loginEmail" required>
          </div>
        </div>
        <button type="submit" name="forgotPassSubmit" class="btn btn-primary">Submit</button>
      </form>
      <?php echo $data->message; ?>
    </div>
  </div>
</body>

</html>
