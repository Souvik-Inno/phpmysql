<?php

  // If not logged in go to home page.
  session_start();
  if(!isset($_SESSION['logged'])){
    header('location: loginPage.php');
  }

  /**
   * Creating class object and passing value to it for validation.
   * If validation successful then go to result page.
   */
  require 'classes/classFormData.php';
  $formData = new FormData();
  if (isset($_POST['form6Submit'])) {
    $image = $_FILES['image'];
    $formData->setImage($image);
    $formData->setFirstName($_POST['inputFirstName']);
    $formData->setLastName($_POST['inputLastName']);
    $fullName = $formData->inputFirstName . ' ' . $formData->inputLastName;
    $formData->uploadImage();
    $formData->setTableDataArray($_POST['marks']);
    $formData->setPhone($_POST['inputPhone']);
    $formData->setEmailId($_POST['inputEmail']);
    if ($formData->fullErrorCheck()) {
      $_SESSION['formData'] = $formData;
      header('location: results/assign6result.php');
    }
  }
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

  <title>PHP Assign 6</title>
  <!--  Including jquery. -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</head>

<body class="bg-image">
  <!-- Header starts here. -->
  <header class="bg-dark">
    <div class="header-container container">
      <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="FALSE" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="navbar-brand" href="assign4.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assign1.php">PHP assign 1</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assign2.php">PHP assign 2</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assign3.php">PHP assign 3</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assign4.php">PHP assign 4</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="assign5.php">PHP assign 5</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="assign6.php">PHP assign 6</a>
            </li>
          </ul>
          <form class="form-inline my-2 my-lg-0" method="post" action="logout.php">
            <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Log Out</button>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <!-- Main Section with Form. -->
  <div class="main m-5">
    <div class="main-container container-form blur-container">
      <form class="assign6Form m-3" method="post" action="assign6.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="inputFirstName">First Name</label>
          <input type="text" class="form-control" id="inputFirstName" name="inputFirstName" aria-describedby="emailHelp"
            placeholder="Enter First Name">
          <span class="red"><?php echo "{$formData->errors['inputFirstName']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputLastName">Last Name</label>
          <input type="text" class="form-control" id="inputLastName" name="inputLastName" placeholder="Last Name">
          <span class="red"><?php echo "{$formData->errors['inputLastName']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="inputFullName">Full Name</label>
          <input type="text" class="form-control" id="inputFullName" name="inputFullName" placeholder="Full Name"
            disabled>
        </div>
        <div class="form-group">
          <label for="image">Upload Image:</label>
          <input type="file" id="image" name="image">
          <span class="red"><?php echo "{$formData->errors['image']}"; ?></span>
        </div>
        <div class="form-group">
          <label for="marks">Enter Subject and Marks:</label>
          <br>
          <textarea rows="10" cols="30" name="marks" placeholder="Subject|Marks"></textarea>

          <?php echo "<span class='red'>{$formData->errors['tableDataArray']}</span>"; ?>
        </div>
        <div class="form-group">
          <label for="inputPhone">Enter Phone Number:</label>
          <input type="text" class="form-control" id="inputPhone" name="inputPhone" placeholder="Enter Phone Number" value="+91">
          <?php echo "<span class='red'>{$formData->errors['phoneNumber']}</span>"; ?>
        </div>
        <div class="form-group">
          <label for="inputPhone">Email id:</label>
          <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter Email id" value="">
          <?php echo "<span class='red'>{$formData->errors['emailId']}</span>"; ?>
        </div>
        <button type="submit" name="form6Submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


  <!-- Optional JavaScript. -->
  <!-- JQuery first, then Popper.js, then Bootstrap JS. -->
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

  <!-- Including jquery code. -->
  <script>
    // For retrieving full name from first and last name.
    $("input[name='inputFirstName'], input[name='inputLastName']").on("input", function () {
      var field1 = $("input[name='inputFirstName']").val();
      var field2 = $("input[name='inputLastName']").val();
      $("input[name='inputFullName']").val(field1 + ' ' + field2);
    });

    // Form validation with regex.
    var alphabetRegex = /^[a-zA-Z']+$/;
    $("input[name='inputFirstName']").on("input", function(){
      var field1 = $("input[name='inputFirstName']").val();
      var field2 = $("input[name='inputLastName']").val();
      if (!alphabetRegex.test(field1)) {
        alert("Name should have alphabets only");
        $("input[name='inputFirstName']").val(field1.slice(0, -1));
        $("input[name='inputFullName']").val(field1.slice(0, -1) + ' ' + field2);
      }
    });
    $("input[name='inputLastName']").on("input", function(){
      var field1 = $("input[name='inputFirstName']").val();
      var field2 = $("input[name='inputLastName']").val();
      if (!alphabetRegex.test(field2)) {
        alert("Name should have alphabets only");
        $("input[name='inputLastName']").val(field2.slice(0, -1));
        $("input[name='inputFullName']").val(field1 + ' ' + field2.slice(0, -1));
      }
    });

    // Check if file provided is image or not.
    $("input[type='file']").change(function () {
      var file = this.files[0];
      if (!file.type.match(/image.*/)) {
        alert("The selected file is not an image");
        event.preventDefault();
      }
    });

    // Full form validation
    $(".assign6Form").submit(function (event) {
      var inputFirstName = $("input[name='inputFirstName']").val();
      var inputLastName = $("input[name='inputLastName']").val();
      var inputPhone = $("input[name='inputPhone']").val();
      if (!inputFirstName) {
        alert("First Name is Required!");
        event.preventDefault();
      }
      else if (!inputLastName) {
        alert("last Name is Required!");
        event.preventDefault();
      }
      else if (!alphabetRegex.test(inputFirstName) || !alphabetRegex.test(inputLastName)) {
        alert("Name should contain alphabets only");
        event.preventDefault();
      }
      else if(inputPhone.substring(0, 3) != "+91"){
        alert("Phone number should start with +91");
        event.preventDefault();
      }
      else if(inputPhone.length != 13){
        alert("Phone number should have 10 digits only");
        event.preventDefault();
      }
      else if(!$.isNumeric(inputPhone)){
        alert("Phone number should be numbers only");
        event.preventDefault();
      }
    });
  </script>
</body>

</html>
