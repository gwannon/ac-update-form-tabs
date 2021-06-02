<label><b><?php _e('Email', 'ac-update-forms'); ?></b><br/><?php echo $contact->email; ?></label>

<?php foreach ($formFields as $id => $field ) { if($field['position'] == 'pre') { ?>
  <label><b><?php echo $field['label']; ?><?php echo ($field['required'] ? "*" : ""); ?></b><br/>
    <?php if(isset($field['select'])) { ?>
      <select name="ac[field][<?php echo $field['id']."-".$field['field']; ?>]" oninvalid="onError();" <?php echo ($field['required'] ? " required" : ""); ?>>
        <option value=""><?php printf(__('Elige tu %s', 'ac-update-forms'), mb_strtolower($field['label'])); ?></option>
        <?php foreach($field['select'] as $select) { ?>
          <option value="<?php echo $select['label']; ?>"<?php echo ($field['value'] == $select['label'] ? " selected='selected'" : ""); ?>><?php echo $select['text']; ?></option>
        <?php } ?>
      </select>
    <?php } else { ?>
      <input type="<?php echo ($field['type'] != '' ? $field['type'] : "text"); ?>" name="ac[field][<?php echo $field['id']."-".$field['field']; ?>]" value="<?php echo $field['value']; ?>" placeholder="<?php echo $field['label']; ?>" oninvalid="onError();" <?php echo ($field['required'] ? " required" : ""); ?><?php echo ($field['pattern'] ? " pattern='".$field['pattern']."'" : ""); ?> />
    <?php } } ?>
  </label>
<?php } ?>


<?php foreach ($formData as $label => $input ) { ?>
  <label><b><?php echo $input['name']; ?><?php echo ($input['required'] ? "*" : ""); ?></b><br/>
    <input type="<?php echo ($input['type'] != '' ? $input['type'] : "text"); ?>" name="ac[data][<?php echo $label; ?>]" value="<?php echo $contact->{$label}; ?>" placeholder="<?php echo $input['name']; ?>" oninvalid="onError();"<?php echo ($input['required'] ? " required" : ""); ?> <?php echo ($input['pattern'] ? " pattern='".$input['pattern']."'" : ""); ?> />
  </label>
<?php } ?>


<?php foreach ($formFields as $id => $field ) { if($field['position'] == 'post') { ?>
  <label><b><?php echo $field['label']; ?><?php echo ($field['required'] ? "*" : ""); ?></b><br/>
    <?php if(isset($field['select'])) { ?>
      <select name="ac[field][<?php echo $field['id']."-".$field['field']; ?>]" oninvalid="onError();" <?php echo ($field['required'] ? " required" : ""); ?>>
        <option value=""><?php printf(__('Elige tu %s', 'ac-update-forms'), mb_strtolower($field['label'])); ?></option>
        <?php foreach($field['select'] as $select) { ?>
          <option value="<?php echo $select['label']; ?>"<?php echo ($field['value'] == $select['label'] ? " selected='selected'" : ""); ?>><?php echo $select['text']; ?></option>
        <?php } ?>
      </select>
    <?php } else { ?>
      <input type="<?php echo ($field['type'] != '' ? $field['type'] : "text"); ?>" name="ac[field][<?php echo $field['id']."-".$field['field']; ?>]" value="<?php echo $field['value']; ?>" placeholder="<?php echo $field['label']; ?>" oninvalid="onError();" <?php echo ($field['required'] ? " required" : ""); ?><?php echo ($field['pattern'] ? " pattern='".$field['pattern']."'" : ""); ?> />
    <?php } } ?>
  </label>
<?php } ?>