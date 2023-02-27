<?php

$errors = [];
$errorMessage = '';

if (!empty($_POST)) {
   $name = $_POST['name'];
   $email = $_POST['email'];
   $subject = $_POST['subject']
   $message = $_POST['message'];

   if (empty($name)) {
       $errors[] = 'Name cannot be left empty.';
   }

   if (empty($email)) {
       $errors[] = 'Email cannot be left empty.';
   } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
       $errors[] = 'Email is invalid';
   }

   if (empty($subject)) {
       $errors[] = 'Subject cannot be left empty.';
   }

   if (empty($message)) {
       $errors[] = 'Message cannot be left empty.';
   }

   if (empty($errors)) {
       $toEmail = 'thelostchandlery@gmail.com';
       $emailSubject = 'New email from your contact form';
       $headers = ['From' => $email, 'Reply-To' => $email, 'Content-type' => 'text/html; charset=utf-8'];
       $bodyParagraphs = ["Name: {$name}", "Email: {$email}", "Subject: {$subject}", "Message:", $message];
       $body = join(PHP_EOL, $bodyParagraphs);

       if (mail($toEmail, $emailSubject, $body, $headers)) 

           header('Location: thank-you.html');
       } else {
           $errorMessage = 'Oops, something went wrong. Please try again later';
       }

   } else {

       $allErrors = join('<br/>', $errors);
       $errorMessage = "<p style='color: #8c0e0f;'>{$allErrors}</p>";
   }
}

?>