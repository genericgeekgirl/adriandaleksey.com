<?php    

require_once("lib.php");

echo page_header("Responses", true, "js/response-submit.js");

$required_fields = array('name', 'response', 'menu');
foreach ($required_fields as $field) { $errorbox[$field] = "errorbox-good"; }

$form_action = "";
$hidden_values = "";

if (!empty($_REQUEST['submit'])) {

  extract($_REQUEST);

  $bad = "errorbox-bad";
  if (empty($name)) { $errorbox['name'] = $bad; }
  if (empty($response)) { $errorbox['response'] = $bad; }
  if (!empty($response) && $response == 'yes' && empty($menu)) { $errorbox['menu'] = $bad; }
  if (!empty($response) && $response == 'no') { unset($menu); }

  if (!in_array($bad, $errorbox)) {

    // generate hidden input elements, linking google's field names with ours
    $name_value = array('entry.11.single'=>$name, 'entry.9.group'=>$response, 'entry.15.single'=>$comments, 'entry.16.single'=>$message);

    foreach ($name_value as $g_name => $value) { $hidden_values .= '<input type="hidden" name="'.$g_name.'" value="'.$value.'" />'."\n"; }

    if (isset($menu)) {
      $menu_options = array('Non-vegetarian' => 1, 'Vegetarian' => 2);
      foreach ($menu as $choice) {
	$id = $menu_options[$choice];
	$hidden_values .= '<input type="hidden" name="entry.14.group" value="'.$choice.'" id="group_14_'.$id.'" />'."\n";
      } 
    }
  ?>

  <noscript>
  <?php $form_action = "https://spreadsheets.google.com/formResponse?formkey=dC1xVzd6UGRHUlhaYkhLYW1BS2NxSlE6MQ&amp;ifq"; ?>
  </noscript>

  <form name="google" method="post" target="innertarget">
  <?= $hidden_values ?>
  </form>

  <iframe src="blank.html" id="innertarget" name="innertarget" style="width: 310px; height=10px; float: left; "></iframe>
  <!-- and once the jquery "onReady" fires, the form will get submitted with the iframe as the load target.  see js/responses-submit.js -->

<?php
    }
}
?>

<?= form_header("Responses", "We look forward to celebrating with you! Please respond by April 20.") ?>

<div class="form-container"><form method="POST" action="<?= $form_action ?>">

<?= $hidden_values ?>

<div class="form-entry">
<div class="<?= $errorbox['name'] ?>">
<div class="field-required"></div>
<span class="field-unified">
Name(s): <input type="text" name="name" size="50%" value="<?= (isset($name)) ? $name : "" ?>" />
</span>
</div>
</div>

<div class="form-entry">
<div class="<?= $errorbox['response'] ?>">
<div class="field-required"></div>
<span class="field-unified">
   <?php foreach (array('yes' => 'would not miss it for the world!','no' => 'will have to miss out on the fun.') as $value=>$label) {
     $checked = (isset($response) && $response == $value) ? 'checked' : '';
   ?>
<label for="<?= $value ?>"><input type="radio" name="response" value="<?= $value ?>" id="<?= $value ?>" <?= $checked ?> /><?= $label ?></label>
   <?php } ?>
</span>
</div>
</div>

<div class="form-entry">
<div class="<?= $errorbox['menu'] ?>">
<span class="field-unified">
  Menu preference: 
  <?php foreach (array('Non-vegetarian', 'Vegetarian') as $value) {
    $checked = (isset($menu) && in_array($value, $menu)) ? 'checked' : '';
  ?>
<label for="<?= $value ?>"><input type="checkbox" name="menu[]" value="<?= $value ?>" id="<?= $value?>" <?= $checked ?> /><?= $value ?></label>
  <?php } ?>
</span>
</div>
</div>

<div class="form-entry">
<div class="errorbox-good">
<span class="field-unified">
What song would get you on the dance floor?<br />
  <input type="text" name="comments" size="60%" value="<?= (isset($comments)) ? $comments : "" ?>" />
</span>
</div>
</div>
 
<div class="form-entry">
<div class="errorbox-good">
<span class="field-unified">
A message for the couple:<br/>
  <input type="text" name="message" size="60%" value="<?= (isset($message)) ? $message : "" ?>" />
</span>
</div>
</div>

<div class="form-submit"><input type="submit" name="submit" value="Submit" /></div>

</form></div>

<?= form_footer() ?>
<?= page_footer() ?>
