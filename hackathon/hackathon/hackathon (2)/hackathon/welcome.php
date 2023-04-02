<html>
    <body>
        
   
<?php
require_once('vendor/autoload.php'); // Include the Razorpay PHP library

use Razorpay\Api\Api;

$api = new Api('764360278547', '1234'); // Replace with your own API key ID and secret

$payment_id = $_POST['razorpay_payment_id'];

$payment = $api->payment->fetch($payment_id);

if ($payment->status === 'captured') {
  // Payment succeeded, take appropriate action (e.g. update database, send email, etc.)
  $to = 'customer@example.com'; // Replace with customer's email address
  $subject = 'Payment Confirmation';
  $message = 'Thank you for your payment!';
  $headers = 'From: your-email@example.com' . "\r\n" .
             'Reply-To: your-email@example.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

  if (mail($to, $subject, $message, $headers)) {
    echo 'Email sent successfully.';
  } else {
    echo 'Email sending failed.';
  }
} else {
  // Payment failed, handle error appropriately
  $error_code = $payment->error->code;
  $error_description = $payment->error->description;
  // Log the error or display a user-friendly error message
  echo 'Payment failed with error code: ' . $error_code . ' - ' . $error_description;
}
?>
 </body>
</html>
