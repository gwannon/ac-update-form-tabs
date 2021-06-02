<?php if (isset($_REQUEST['email']) && is_email($_REQUEST['email'])) { 
  $result =  acSearchUserByEmail($_REQUEST['email']);
  if(count($result) > 0) {
    $contact = $result[0];

    //Preparamos el email
    $headers = array("From: wordpress@enuttisworking.com", "Reply-To: wordpress@enuttisworking.com", "X-Mailer: PHP/".phpversion(), "Content-type: text/html; charset=utf-8");
    $link = get_the_permalink()."?hash=".$contact->hash."&contact_id=".$contact->id;
    $message = str_replace("[LINK]", $link, file_get_contents(dirname(__FILE__)."/../templates/email_es.html"));
    wp_mail ($_REQUEST['email'], __("Aquí puedes actualizar tus preferencias de suscripción a Grupo SPRI", 'ac-update-forms'), $message, $headers);
    ?><p class="ok"><?php _e('Para actualizar tus preferencias de suscripción, comprueba tu correo electrónico porque te hemos enviado un mensaje con los pasos para poder hacerlo.', 'ac-update-forms'); ?></p><?php 
  } else { ?>
    <p class="error"><?php _e('Email incorrecto. El email suministrado no está en nuestra base de datos.', 'ac-update-forms'); ?></p>
  <?php }
} else if (isset($_REQUEST['email'])) { ?>
  <p class="error"><?php _e('Email incorrecto. El email suministrado no tiene el formato adecuado.', 'ac-update-forms'); ?></p>
<?php } ?>
<form method="post">
  <input type="email" name="email" value="" placeholder="<?php _e('Email', 'ac-update-forms'); ?>" required />
  <input type="submit" name="send" value="<?php _e('Enviar', 'ac-update-forms'); ?>" />
</form>