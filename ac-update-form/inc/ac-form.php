<form method="post">
  <div class="row">
    <ul class="tabs-selector">
      <li id="tab-selector-1" data-open="tab1" class="current"><?php _e('Comunicaciones', 'ac-update-forms'); ?></li>
      <li id="tab-selector-2" data-open="tab2"><?php _e('Datos personales', 'ac-update-forms'); ?></li>
    </ul>
    <div class="tab current" id="tab1">
      <?php include(dirname(__FILE__)."/ac-form-tab1.php"); ?>
    </div>
    <div class="tab" id="tab2">
      <?php include(dirname(__FILE__)."/ac-form-tab2.php"); ?>
    </div>
    <label><b><?php _e('Protección de datos*', 'ac-update-forms'); ?></b><br/>
      <input type="checkbox" required id="avisolegal" /> <?php _e('Sí, he LEÍDO y ACEPTO en todos sus términos la Información legal incluida en la <a href="#">política de privacidad</a>', 'ac-update-forms'); ?>
      <p class="minilegal"><?php _e('SPRI-Agencia Vasca de Desarrollo Empresarial (www.spri.eus), como responsable del tratamiento y con quien puede contactar mediante el mail lopd@spri.eus recoge sus datos personales con la finalidad de prestarle el adecuado servicio de atención en relación a nuestros servicios y programas de ayudas. Para conocer en detalle los derechos que le asisten y disponer de información ampliada respecto a las finalidades y legitimación del tratamiento puede dirigirse a esta página.', 'ac-update-forms'); ?></p>
    </label>
    <input type="submit" class="" name="update" value="<?php _e('Actualizar', 'ac-update-forms'); ?>" disabled="disabled" />
  </div>
</form>
<script>
  jQuery('.checkbox-boletines').click(function() {
    if(jQuery(this).is(":checked")) {
      jQuery("#"+jQuery(this).attr("id").replace("checkbox", "hidden")).val("Sí");
    } else {
      jQuery("#"+jQuery(this).attr("id").replace("checkbox", "hidden")).val("No");
    }
  });

  jQuery("form ul.tabs-selector li").click(function(){
    jQuery(".tab.current").removeClass("current");
    jQuery("form ul.tabs-selector li").removeClass("current");
    jQuery("#"+jQuery(this).data("open")).addClass("current");
    jQuery(this).addClass("current");
  });

  jQuery("#select-all-empresa").change(function() {
    jQuery(".checkbox-tag-empresa").prop('checked', jQuery(this).is(':checked'));
  });

  jQuery("#select-all-preferencias").change(function() {
    jQuery(".checkbox-tag-preferencias").prop('checked', jQuery(this).is(':checked'));
  });

  jQuery("#avisolegal").change(function() {
    jQuery("form input[type=submit]").prop('disabled', !jQuery(this).is(':checked'));
  });

  jQuery("#select-all-intereses").change(function() {
    jQuery(".checkbox-tag-intereses").prop('checked', jQuery(this).is(':checked'));
  });

  function onError() {
    jQuery(".tab.current").removeClass("current");
    jQuery("form ul.tabs-selector li").removeClass("current");
    jQuery("#tab2").addClass("current");
    jQuery("#tab-selector-2").addClass("current");
  }
</script>