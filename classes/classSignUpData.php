<?php

  /**
   *  @file contains class SignUpData.
   * 
   *  Class SignUpData contains data for signing up.
   */
  class SignUpData {

    /**
     *  @var string $firstname
     *    Contains first name.
     */
    public $firstname;
    /**
     *  @var string $email
     *    Contains email.
     */
    public $email;
    /**
     *  @var string $password
     *    Contains password.
     */
    public $password;
    /**
     *  @var mysqli $conn
     *    Connects to mysql database.
     */
    public $conn;
    /**
     *  @var string $message
     *    Contains success or fail message.
     */
    public $message;

    /**
     *  Contructor to initialize data on form submit and sign up user.
     */
    public function __construct() {
      if(isset($_POST['signUpSubmit'])) {
        $this->firstname = $_POST['inputFirstName'];
        $this->email = $_POST['loginEmail'];
        $this->password = $_POST['signUpPass'];
        $reEnterPassword = $_POST['reEnterPassword'];
        if($this->password != $reEnterPassword) {
          $this->message = "*Password not same as re-entered field";
        }
        else {
          $this->signUpUser();
        }
      }
    }

    /**
     *  Function to connect to Database.
     * 
     *  @return void
     */
    public function connectDB() {
      require_once("classes/classPass.php");
      $pass = new Pass();
      $this->conn = new mysqli($pass->getServerName(), $pass->getusername(), $pass->getPassword(), $pass->getDBName());
      if ($this->conn->connect_error) {
        die("Connection failed: " . $this->conn->connect_error);
      }
    }

    /**
     *  Function signs up user by inserting user data in database.
     *  Then heads to homepage of php basic assignment.
     * 
     *  @return void
     */
    public function signUpUser() {
      $this->connectDB();
      $query = "CREATE TABLE IF NOT EXISTS userdata(
        firstname VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        PRIMARY KEY (email)
      );";
      $smtp = $this->conn->prepare($query);
      $smtp->execute();
      $check = "SELECT email FROM userdata WHERE email = '$this->email'";
      $checkRes = $this->conn->query($check);
      if($checkRes->num_rows > 0) {
        $this->message = "*Email already exists";
      }
      else {
        $this->password = md5($this->password);
        $passVal = "INSERT INTO userdata (firstname, email, password)
        VALUES('$this->firstname', '$this->email' , '$this->password')";
        $this->conn->query($passVal);
        $_SESSION['email'] = $this->email;
        $_SESSION['logged'] = TRUE;
        header("location: assign4.php");
      }
    }

    /**
     *  Destructor closes connection if open.
     */
    public function __destruct() {
      if ($this->conn) {
        $this->conn->close();
      }
    }

  }
?>
