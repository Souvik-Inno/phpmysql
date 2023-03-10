<?php

  // Gets data from Form2 and stores in object.
  require '../classes/classFormData.php';
  session_start();
  $formData = new FormData();
  $formData = $_SESSION['formData'];

  // Creates fullname from first and second name. 
  $fullName = $formData->inputFirstName . ' ' . $formData->inputLastName;
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
  <link rel="stylesheet" href="../css/style.css">

  <title>Assign1 Result</title>
  <!-- Import jquery. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="bg-image">
  <div class="main m-5">
    <div class="main-container container-form flex-col blur-container">
      <!-- Show the contents. -->
      <img src='<?php echo "../$formData->destination" ?>' alt="profile pic" class="profile-pic">
      <h2>
        Hello
        <?php echo "$fullName" ?>
      </h2>
      <a href="../assign2.php">Go Back</a>
    </div>
  </div>

</body>

</html>
