<?php
// Redirect if direct access to script
if( $_SERVER['REQUEST_URI'] == $_SERVER['PHP_SELF'] && $_SERVER['HTTP_X_REQUESTED_WITH'] != 'XMLHttpRequest' ) {
  header('Location: .');
}
$result = '';
$to = 'perandre@front.no';

// spam check
if( !empty($_POST) ) {

  $subject = 'Apputvikling.no: ' . stripcslashes($_POST['subject']);
  $name = stripcslashes($_POST['name']);
  $email = stripcslashes($_POST['email']);
  $message = stripcslashes($_POST['message']);
  $contactMessage = "$subject \r \n"
                ."Message: $message \r \n"
                ."From: $name \r \n"
                ."Reply to: $email";

  // email check
  if( eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email) ) {
    ini_set('sendmail_from', $email);
    mail($to, $subject, $contactMessage);

    $result = '<div class="alert alert-success">Your message has been sent! Thank you for contacting us! :)</div>';
    $_POST = array();
  }
  else {
    $result = '<div class="alert alert-error">Ooops! It appears your email address is not valid! :(</div>';
  }
}

print $result;
