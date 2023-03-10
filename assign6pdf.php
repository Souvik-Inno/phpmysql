<?php

  // Get form data and generate pdf with the data.
  if (isset($_POST['btnDownload'])) {
    require("classes/classFormData.php");
    require("../phpmysql/vendor/autoload.php");
    $formData = new FormData();
    session_start();
    $formData = $_SESSION['formData'];
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->Cell(0, 10, 'Form Details', 1, 1, 'C');
    $pdf->Cell(90, 10, 'First Name: ', 1, 0);
    $pdf->Cell(100, 10, $formData->inputFirstName, 1, 1);
    $pdf->Cell(90, 10, 'Last Name: ', 1, 0);
    $pdf->Cell(100, 10, $formData->inputLastName, 1, 1);
    $pdf->Cell(90, 10, 'First Name: ', 1, 0);
    $pdf->Cell(100, 10, $formData->inputFirstName, 1, 1);
    $pdf->Cell(90, 50, 'Profile Pic: ', 1, 0);
    $pdf->Image($formData->destination, 120, 50, 70, 50);
    $pdf->Ln(50);
    $lines = explode("\n", $formData->tableDataArray);
    foreach ($lines as $line) {
      list($subject, $mark) = explode("|", $line);
      $pdf->Cell(90, 10, $subject, 1, 0);
      $pdf->Cell(100, 10, $mark, 1, 1);
    }
    $pdf->Cell(90, 10, 'Phone Number: ', 1, 0);
    $pdf->Cell(100, 10, $formData->phoneNumber, 1, 1);
    $pdf->Cell(90, 10, 'Email Id: ', 1, 0);
    $pdf->Cell(100, 10, $formData->emailId, 1, 1);
    $pdf->Output('F', 'files/assign6.pdf');
    $pdf->Output();
    ob_end_flush();
  }
?>
