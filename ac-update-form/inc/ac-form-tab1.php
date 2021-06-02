<label>
  <label><b><?php _e('Boletines', 'ac-update-forms'); ?></b></label>
  <?php foreach ($formNewslettersFields as $id => $field ) { ?>
    <label><input class="checkbox-boletines" type="checkbox" id="checkbox-<?php echo $id."-".$field['field']; ?>" name="checkbox-<?php echo $id."-".$field['field']; ?>" value="1" <?php echo ($field['value'] == 'Sí' ? "checked" : "") ?> /> <?php echo $field['label']; ?></label>
    <p><small><?php echo $field['description']; ?></small></p>
    <input type="hidden" id="hidden-<?php echo $id."-".$field['field']; ?>" name="ac[newsletter][<?php echo $field['id']."-".$field['field']; ?>]" value="<?php echo $field['value']; ?>" />
  <?php } ?>
</label>



<?php /* <label>
  <label><b><?php _e('¿Tienes alguna preferencia relacionada con las ayudas del Grupo SPRI?', 'ac-update-forms'); ?></b></label>
  <?php foreach ($tags as $tag ) { if($tag['position'] == 'preferencias') { ?>
    <label><input type="checkbox" class="checkbox-tag-preferencias" id="checkbox-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][status]" value="add" <?php echo ($tag['has_tag'] == true ? "checked" : "") ?> /> <?php echo $tag['text']; ?></label>
    <input type="hidden" id="hidden-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][tag]" value="<?php echo $tag['my_tag']; ?>" />
  <?php } } ?>
  <label><input type="checkbox" id="select-all-preferencias" /> <?php _e('Me interesa recibir información de todos los productos.', 'ac-update-forms'); ?></label>
</label> */ ?>



<label>
  <label><b><?php _e('¿Con cuál de nuestros perfiles de empresa te identificas?', 'ac-update-forms'); ?></b></label>
  <?php foreach ($tags as $tag ) { if($tag['position'] == 'empresa') { ?>
    <label><input type="checkbox" class="checkbox-tag-empresa" id="checkbox-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][status]" value="add" <?php echo ($tag['has_tag'] == true ? "checked" : "") ?> /> <?php echo $tag['text']; ?></label>
    <input type="hidden" id="hidden-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][tag]" value="<?php echo $tag['my_tag']; ?>" />
  <?php } } ?>
  <label><input type="checkbox" id="select-all-empresa" /> <?php _e('Me interesa recibir la información para cualquiera de estos perfiles.', 'ac-update-forms'); ?></label>
</label>



<label>
  <label><b><?php _e('¿Alguna prioridad respecto a la temática?', 'ac-update-forms'); ?></b></label>
  <?php foreach ($tags as $tag ) { if($tag['position'] == 'intereses') { ?>
    <label><input type="checkbox" class="checkbox-tag-intereses" id="checkbox-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][status]" value="add" <?php echo ($tag['has_tag'] == true ? "checked" : "") ?> /> <?php echo $tag['text']; ?></label>
    <input type="hidden" id="hidden-tag-<?php echo $tag['id']; ?>" name="ac[tags][<?php echo $tag['id']; ?>][tag]" value="<?php echo $tag['my_tag']; ?>" />
  <?php } } ?>
  <label><input type="checkbox" id="select-all-intereses" /> <?php _e('Me interesan los contenidos de todas estas temáticas.', 'ac-update-forms'); ?></label>
</label>





<label>
  <label><b><?php _e('¿En qué idioma quieres recibirnos?', 'ac-update-forms'); ?></b></label>
  
    <?php foreach ($langs as $lang ) { ?>
      <label><input type="checkbox" class="checkbox-lang" id="checkbox-lang-<?php echo $lang['id']; ?>" name="ac[langs][<?php echo $lang['id']; ?>][status]" value="add" <?php echo ($lang['has_tag'] == true ? "checked" : "") ?> /> <?php echo $lang['text']; ?></label>
      <input type="hidden" id="hidden-lang-<?php echo $lang['id']; ?>" name="ac[langs][<?php echo $lang['id']; ?>][tag]" value="<?php echo $lang['my_tag']; ?>" />
      <?php /* <script>
        jQuery('#checkbox-lang-<?php echo $lang['id']; ?>').click(function() {
          if(jQuery(this).is(":checked")) {
            jQuery('.checkbox-lang').not(this).prop( "checked", false );
          }
        });
      </script> */ ?>
    <?php } ?>
  </label>
</label>
