
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>
<script type="text/javascript">
var messageDelay = 2000; 
$( init );
function init() {
  $('#contactForm').hide().submit( submitForm ).addClass( 'positioned' );
  $('a[href="#contactForm"]').click( function() {
    $('#content').fadeTo( 'slow', .2 );
    $('#contactForm').fadeIn( 'slow', function() {
      $('#senderName').focus();
    } )
    return false;
  } );
  
    $('#cancel').click( function() { 
    $('#contactForm').fadeOut();
    $('#content').fadeTo( 'slow', 1 );
  } );  
  
  $('#contactForm').keydown( function( event ) {
    if ( event.which == 27 ) {
      $('#contactForm').fadeOut();
      $('#content').fadeTo( 'slow', 1 );
    }
  } );
}

function submitForm() {
  var contactForm = $(this);

  if ( !$('#senderName').val() || !$('#senderEmail').val() || !$('#message').val() ) {
    $('#incompleteMessage').fadeIn().delay(messageDelay).fadeOut();
    contactForm.fadeOut().delay(messageDelay).fadeIn();

  } else {
    $('#sendingMessage').fadeIn();
    contactForm.fadeOut();

    $.ajax( {
      url: contactForm.attr( 'action' ) + "?ajax=true",
      type: contactForm.attr( 'method' ),
      data: contactForm.serialize(),
      success: submitFinished
    } );
  }
  return false;
}

function submitFinished( response ) {
  response = $.trim( response );
  $('#sendingMessage').fadeOut();

  if ( response == "success" ) {
    $('#successMessage').fadeIn().delay(messageDelay).fadeOut();
    $('#senderName').val( "" );
    $('#senderEmail').val( "" );
    $('#message').val( "" );
    $('#content').delay(messageDelay+500).fadeTo( 'slow', 1 );

  } else {
    $('#failureMessage').fadeIn().delay(messageDelay).fadeOut();
    $('#contactForm').delay(messageDelay+500).fadeIn();
  }
}

</script>
<a href="#contactForm">Enviar mensagem</a>
<form id="contactForm" action="mailto.php" method="post">

      <label for="senderName">Nome<br></label>
      <input type="text" name="senderName" id="senderName" placeholder="Seu nome, por favor" required="required" maxlength="40" /><br>

      <label for="senderEmail">Email<br></label>
      <input type="email" name="senderEmail" id="senderEmail" placeholder="Necess&#225;rio um email" required="required" maxlength="50" /><br>

      <label for="message" style="padding-top: .5em;">Mensagem<br></label>
      <textarea name="message" id="message" placeholder="Por favor, digite sua mensagem" required="required" cols="30" rows="5" maxlength="1000"></textarea><br>

  <div id="formButtons">
    <input type="submit" id="sendMessage" name="sendMessage" value="ENVIAR" />
    <input type="button" id="cancel" name="cancel" value="CANCELAR" />
  </div>
</form>

<div id="sendingMessage" class="statusMessage" style="display: none;"><p>Enviando, aguarde...</p></div>
<div id="successMessage" class="statusMessage" style="display: none;"><p>Grato por seu contato. Responderemos em breve.</p></div>
<div id="failureMessage" class="statusMessage" style="display: none;"><p>Ocorreu um problema com sua mensagem. Por favor, envie email para <a href='mailto:web@eletricistaubatuba.com.br'>web@eletricistaubatuba.com.br</a></p></div>
<div id="incompleteMessage" class="statusMessage" style="display: none;"><p>Por favor, preencha todos os campos antes de enviar.</p></div>

