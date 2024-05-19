<?php
$to = 'raihr7121@gmail.com'; // Destination email address
$subject = 'New message from website'; // Email subject

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

$headers = 'From: ' . $email . "\r\n" .
           'Reply-To: ' . $email . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

// Compose the email message
$email_message = "Name: $name\n\n" .
                 "Email: $email\n\n" .
                 "Message:\n$message";

// Send the email
mail($to, $subject, $email_message, $headers);

// Redirect back to the form page
//header('Location: thank_you.html');
return redirect()->route('panel.login');
exit;
?>
