<?php
/**
 * Plugin Name: ActiveCampignUpdateForm
 * Plugin URI:  https://www.enutt.net/
 * Description: Formulario para actualizar los datos de los usuarios de Active Campaign de SPRI
 * Version:     1.0
 * Author:      Eñutt
 * Author URI:  https://www.enutt.net/
 * License:     GNU General Public License v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ac-update-forms
 *
 * PHP 7.3
 * WordPress 5.5.3
 */

//ini_set("display_errors", 1);

define('AC_API_DOMAIN', ''); 
define('AC_API_TOKEN', '');
//print_pre(acGetTags());

//Cargamos el multi-idioma
function ac_plugins_loaded() {
  load_plugin_textdomain('ac-update-forms', false, dirname( plugin_basename( __FILE__ ) ) . '/langs/' );
}
add_action('plugins_loaded', 'ac_plugins_loaded', 0 );

//Shortocodes --------------------------------------------------------------
function ac_update_forms_shortcode($params = array(), $content = null) {
  global $post;
  ob_start(); 

  include(dirname(__FILE__)."/inc/fields.php");

  if (isset($_REQUEST['contact_id']) && $_REQUEST['contact_id'] > 0 && isset($_REQUEST['hash']) && $_REQUEST['hash'] != '') { //Sacamos le formulario de los datos ------------------
    $contact = acGetUserById ($_REQUEST['contact_id']);

    //Actualizamos los datos del usuario
    if($_REQUEST['hash'] == $contact->hash) { //El usuario es el correcto proque tiene el mismo hash

      if(isset($_REQUEST['update']) && $_REQUEST['update'] != '') { //Actualizamos el perfil del usuario
        
        //Actualizamos los datos principales
        $contact = acUpdateFieldsByUserId($contact->id, $_REQUEST['ac']['data']);

        //Actualizamos los campos extras
        foreach ($_REQUEST['ac']['field'] as $key => $value) {
          $temp = explode("-", $key);
          if($temp[0] == 'create') $result = acCreateCustomFieldValueByCustomFieldId($contact->id, $temp[1], $value);
          else $result = acUpdateCustomFieldValueByCustomFieldId($temp[0], $contact->id, $temp[1], $value);
        }

        //Actualizamos las newsletter
        foreach ($_REQUEST['ac']['newsletter'] as $key => $value) {
          $temp = explode("-", $key);
          if($temp[0] == 'create') $result = acCreateCustomFieldValueByCustomFieldId($contact->id, $temp[1], $value);
          else $result = acUpdateCustomFieldValueByCustomFieldId($temp[0], $contact->id, $temp[1], $value);
        }

        //Actualizamos los intereses
        foreach($_REQUEST['ac']['tags'] as $tag_id => $tag) {
          if(!isset($tag['status']) && $tag['tag'] > 0) $result = acDeleteTagUser($tag['tag']);
          else if(isset($tag['status']) && !$tag['tag']) $result = acAddTagUser($contact->id, $tag_id);
        }

        //Actualizamos los idiomas
        foreach($_REQUEST['ac']['langs'] as $tag_id => $tag) {
          if(!isset($tag['status']) && $tag['tag'] > 0) $result = acDeleteTagUser($tag['tag']);
          else if(isset($tag['status']) && !$tag['tag']) $result = acAddTagUser($contact->id, $tag_id);
        }

        //Metemos la fecha de última actualización 243957-39
        $myFields = acGetFieldsByUserId($contact->id); 
        $control = 'create';
        foreach ($myFields as $myField) {
          if ($myField->field == 39) {
            $result = acUpdateCustomFieldValueByCustomFieldId($temp[0], $contact->id, 39, date("Y-m-d"));
            $control = 'update';
            break;
          }
        }
        if($control == 'create') {
          $result = acCreateCustomFieldValueByCustomFieldId($contact->id, 39, date("Y-m-d"));
        }

        ?>
          <p class="ok"><?php _e('Tu información de contacto ha sido actualizada.', 'ac-update-forms'); ?><br/><?php _e('Gracias por tus muestras de confianza hacia nuestro servicio de comunicación. Seguiremos esforzándonos para cubrir tus expectativas.', 'ac-update-forms'); ?></p>
        <?php
      } else $myFields = acGetFieldsByUserId($contact->id);  

      //Preparamos los datos extras
      $formFields = array();
      foreach ($fields as $field) {
        $value = "";
        $temp = array("label" => $field['text'], "value" => $value, "field" => $field['id'], "id" => 'create', "position" => $field['position'], "required" => $field['required']);
        if (isset($field['select'])) $temp['select'] = $field['select'];
        if (isset($field['pattern'])) $temp['pattern'] = $field['pattern'];
        if (isset($field['type'])) $temp['type'] = $field['type'];
        foreach ($myFields as $myField) {
          if ($myField->field == $field['id']) {
            $temp['value'] = $myField->value;
            $temp['id'] = $myField->id;
            break;
          }
        }
        $formFields[] = $temp;
      }
      //print_pre($formFields);

      //Preparamos los datos de newsletter
      $formNewslettersFields = array();
      foreach ($fields_newsletter as $field) {
        $value = "No";
        $temp = array("label" => $field['text'], "value" => $value, "field" => $field['id'], "id" => 'create', "description" => $field['description']);
        foreach ($myFields as $myField) {
          if ($myField->field == $field['id']) {
            $temp['value'] = $myField->value;
            $temp['id'] = $myField->id;
            break;
          }
        }
        $formNewslettersFields[] = $temp;
      }
      //print_pre($formNewslettersFields);

      //Preparamos las etiquetas
      $myTags = acGetUserTagsById ($contact->id);
      foreach ($tags as $key => $tag) {
        $tags[$key]['has_tag'] = false;
        foreach ($myTags as $myTag) {
          if ($myTag->tag == $tag['id']) {
            $tags[$key]['has_tag'] = true;
            $tags[$key]['my_tag'] = $myTag->id;
            break;
          }
        }
      }

      //Preparamos los idiomas
      foreach ($langs as $key => $tag) {
        $langs[$key]['has_tag'] = false;
        foreach ($myTags as $myTag) {
          if ($myTag->tag == $tag['id']) {
            $langs[$key]['has_tag'] = true;
            $langs[$key]['my_tag'] = $myTag->id;
            break;
          }
        }
      }
      include(dirname(__FILE__)."/inc/ac-form.php");     
    } else {
      ?><p class="error"><?php _e('Datos de acceso incorrectos.', 'ac-update-forms'); ?></p><?php
    }
   } else { //Sacamos el miniformulario para pedir el email --------------------------------------------------
    include(dirname(__FILE__)."/inc/ac-form-login.php");
  } 
  include(dirname(__FILE__)."/inc/style.php"); 
  $html = ob_get_clean(); 
  return $html;
}
add_shortcode('ac-update-forms', 'ac_update_forms_shortcode');


include(dirname(__FILE__)."/inc/libs.php");
