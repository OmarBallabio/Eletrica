<?php

// Define some constants
define( "RECIPIENT_NAME", "*******" );
define( "RECIPIENT_EMAIL", "form@******.com.br" );
define( "EMAIL_SUBJECT", "Mensagem via WEB" );

// Read the form values
$success = false;
$senderName = isset( $_POST['senderName'] ) ? preg_replace( "/[^\.\-\' a-zA-Z0-9]/", "", $_POST['senderName'] ) : "";
$senderEmail = isset( $_POST['senderEmail'] ) ? preg_replace( "/[^\.\-\_\@a-zA-Z0-9]/", "", $_POST['senderEmail'] ) : "";
$message = isset( $_POST['message'] ) ? preg_replace( "/(From:|To:|BCC:|CC:|Subject:|Content-Type:)/", "", $_POST['message'] ) : "";

// If all values exist, send the email
if ( $senderName && $senderEmail && $message ) {
	
	   $newentry .= $_SERVER[HTTP_REFERER]."\n\n";	
		$newentry =  $_SERVER[REMOTE_ADDR].$_SERVER['HTTP_X_FORWARDED_FOR']."\n\n";	
		$newentry .= $_SERVER[HTTP_USER_AGENT]."\n\n";
		
		
  $recipient = RECIPIENT_NAME . " <" . RECIPIENT_EMAIL . ">";
  $headers = "From: " . $senderName . " <" . $senderEmail . ">";
  $message .= "\n\n $newentry \n" ;
  $success = mail( $recipient, EMAIL_SUBJECT, $message, $headers );
}

// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Grato!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Sua mensagem foi enviada.<br>Entraremos em contato assim que possível.</p>" ?>
  <?php if ( !$success ) echo "<p>Desculpe.<br>Devido a problemas técnicos não foi possível enviar sua mensagem.<br>Por favor, envie mensagem por e-mail <a href='mailto:" .RECIPIENT_EMAIL. "'>" .RECIPIENT_EMAIL. "</a>" ?>
  <p><a href="javascript:history.back(-1);">V O L T A R</a></p>
  </body>
</html>
<?php
}
?>



