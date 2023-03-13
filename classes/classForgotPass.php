<?php

  /**
   *  @file contains class ForgotPass.
   *  
   *  Requires PHPMailer and Pass class.
   */
  require 'vendor/autoload.php';
  require 'classPass.php';
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  /**
   *  Class ForgotPass contains data for forget password.
   */
  class ForgotPass {
    /**
     *  @var string $toEmail
     *    Contains reciever email.
     */
    public $toEmail;
    /**
     *  @var string $message
     *    Contains error or success message.
     */
    public $message;
    /**
     *  @var mysqli $conn
     *    Connects to mysql database.
     */
    public $conn;
    /**
     *  @var string $password
     *    Contains new/changed password.
     */
    private $password;

    /**
     *  Constructor initialzes and sends mail in case of forgot password
     *  and changes password for password setting form.
     */
    public function __construct() {
      if (isset($_POST['forgotPassSubmit'])) {
        $this->toEmail = $_POST['loginEmail'];
        if ($this->checkMail()) {
          $this->sendMail();
        }
        else {
          echo "wrong mail provided";
        }
      }
      else if (isset($_POST['forgotFormSubmit'])) {
        $this->password = $_POST['forgotFormPass'];
        $reEnterPassword = $_POST['reEnterPassword'];
        if (!$this->checkToken($_GET['token'])) {
          echo "Wrong token";
          exit();
        }
        else if($this->password != $reEnterPassword) {
          $this->message = "*Password do not match re-entered field";
        }
        else {
          $this->changePass();
        }
      }
    }

    /**
     *  Function checks if correct token is given in url.
     * 
     *  @param string $token
     *    Token from url.
     * 
     *  @return bool
     *    TRUE if correct token.
     *    FALSE if incorrect token.
     */
    public function checkToken($token) {
      $this->connectDB();
      $now = date('Y-m-d H:i:s');
      $query = "SELECT email FROM password_reset WHERE token = '$token' AND expires_at > '$now'";
      $result = $this->conn->query($query);
      $this->toEmail = $result->fetch_column();
      if ($result->num_rows > 0) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    /**
     *  Function checks if email id present in database.
     * 
     *  @return bool
     *    TRUE if email present in database.
     *    FALSE if email not present in database.
     */
    public function checkMail() {
      $this->connectDB();
      $query = "SELECT email FROM userdata WHERE '$this->toEmail' = email";
      $result = $this->conn->query($query);
      if ($result->num_rows > 0) {
        return TRUE;
      }
      else {
        return FALSE;
      }
    }

    /**
     *  Function connects to database using mysqli.
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
     *  Function changes password and heads to loginPage.php.
     * 
     *  @return void
     */
    public function changePass() {
      $this->connectDB();
      $this->password = md5($this->password);
      $query = "UPDATE userdata SET password = '$this->password' WHERE email = '$this->toEmail'";
      $this->conn->query($query);
      $this->message = "<span class='green'>Password changed successfully</span>";
      header("location: loginPage.php");
    }

    /**
     *  Function creates token and sends email to user for password change.
     * 
     *  @return void
     */
    public function sendMail() {
      require_once("classPass.php");
      $mail = new PHPMailer(TRUE);
      $pass = new Pass();
      $fromEmail = $pass->getFromEmail();
      $emailPassword = $pass->getEmailPassword();
      $this->connectDB();
      $query = "CREATE TABLE IF NOT EXISTS password_reset (
        id INT(11) NOT NULL AUTO_INCREMENT,
        email VARCHAR(255) NOT NULL,
        token VARCHAR(64) NOT NULL,
        expires_at DATETIME NOT NULL,
        PRIMARY KEY (id)
      );";
      $smtp = $this->conn->prepare($query);
      $smtp->execute();
      $token = bin2hex(random_bytes(32));
      $expires = date('Y-m-d H:i:s', strtotime('+1 day'));
      $smtp  = $this->conn->prepare("INSERT INTO password_reset (email, token, expires_at) VALUES ('$this->toEmail', '$token', '$expires')");
      $smtp->execute();
      try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = TRUE;
        $mail->Username = $fromEmail;
        $mail->Password = $emailPassword;
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
  
        // Set from address and to address.
        $mail->setFrom($fromEmail);
        $mail->addAddress($this->toEmail);
        // TODO: Email Validation to be added.
        // if (!$this->checkEmail()) {
        //   $this->message = "<span class='red'>*Invalid Mail Address Provided!<span>";
        //   return;
        // }
  
        // Content of the mail.
        $mail->isHTML(TRUE);
        $mail->Subject = 'Forgot password Form';
        $mailBody = 'Please click on the following link to reset your password: <br>';
        $mailBody .= 'http://example.com/phpmysql/forgotForm.php' . '?token=' . $token;
        $mail->Body    = $mailBody;
        $mail->AltBody = 'Welcome to the cult!';

        $mail->send();
        $this->message = "<span class='green'>Message has been sent</span>";
      }
      catch (Exception $e) {
        $this->message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
      }
    }

    /**
     *  Destructor closes connection to mysqli if open.
     */
    public function __destruct() {
      if ($this->conn) {
        $this->conn->close();
      }
    }

  }
?>
