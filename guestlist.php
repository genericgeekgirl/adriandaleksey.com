<?php

require_once("lib.php");

echo page_header("Guest List", true, "js/guestlist-submit.js");

$fields = array('name'=>'Name',
		'partner'=>'Significant Other',
		'address1'=>'Mailing Address',
		'address2'=>'City, State, Zipcode',
		'phone'=>'Phone number',
		'email'=>'Email Address',
		'dietary'=>'Dietary Restrictions',
		'hotel'=>'Will you need a hotel?',
                'comments'=>'Anything else?');

foreach ($fields as $field=>$label) { $errorbox[$field] = "errorbox-good"; }

$required_fields = array('name', 'address1', 'address2', 'email');


$form_action = "";
$hidden_values = "";



if (!empty($_REQUEST['submit'])) {

  extract($_REQUEST);

  $bad = "errorbox-bad";

  foreach ($required_fields as $field) { if (empty(${$field})) { $errorbox[$field] = $bad; } }

  if (!in_array($bad, $errorbox)) {

    // generate hidden input elements, linking google's field names with ours                                                                                                                                  
    $name_value = array('entry.0.single'=>$name,
			'entry.8.single'=>$partner,
			'entry.6.single'=>$address1,
			'entry.21.single'=>$address2,
			'entry.4.single'=>$phone,
			'entry.10.single'=>$email,
			'entry.12.single'=>$dietary,
			'entry.22.single'=>$hotel,		
			'entry.20.single'=>$comments);

    foreach ($name_value as $g_name => $value) { $hidden_values .= '<input type="hidden" name="'.$g_name.'" value="'.$value.'" />'."\n"; }

    ?>

  <noscript>
     <?php $form_action = "https://spreadsheets.google.com/formResponse?formkey=dFE2Tm1YOTBkSlJSRnhxODIxVTVURlE6MQ&amp;theme=0AX42CRMsmRFbUy0xMTQxMTU1Yy04OGY5LTRkY2EtYTFjMC02YmNkMmI2OWNhZTQ&amp;ifq" ?>
  </noscript>

  <form name="google" method="post" target="innertarget">
  <?= $hidden_values ?>
  </form>
     
  <iframe src="blank.html" id="innertarget" name="innertarget" style="width: 310px; height=10px; float: left; "></iframe>
  <!-- and once the jquery "onReady" fires, the form will get submitted with the iframe as the load target.  see js/guestlist-submit.js -->

<?php
      }
}
?>


<?= form_header("Guest List","We'd like to invite you to our wedding. Please send us your contact information!") ?>

<div class="form-container"><form method="POST" action="<?= $form_action ?>">

<?= $hidden_values ?>

<?php

foreach ($fields as $field=>$label) { 
  $required = (in_array($field, $required_fields)) ? true : false;
?>

<div class="form-entry">
<div class="<?= $errorbox[$field] ?>">
<span class="field-required"><?= (in_array($field, $required_fields)) ? '*' : '&nbsp;&nbsp;' ?></span>
<span class="field-name"><?= $label ?></span>
<span class="field-input"><input type="text" name="<?= $field ?>" size="25" value="<?= (isset($field)) ? ${$field} : "" ?>" /></span>
</div>
</div>

<?php } ?>


<div class="form-submit"><input type="submit" name="submit" value="Submit" /></div>

</form></div>

<?= form_footer() ?>
<?= page_footer() ?>

