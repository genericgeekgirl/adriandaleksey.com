<?php

function page_header($title, $form=null, $extrascript=null) {

  $stylesheet = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\" />";
  if ($form) { $stylesheet .= "\n<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\" />\n"; }

  $scripts = "<script type=\"text/javascript\" src=\"js/jquery-1.6.1.min.js\"></script>\n";
  if ($extrascript) {
    $scripts .= "<script type=\"text/javascript\" src=\"" . $extrascript . "\"></script>\n";
  }
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>

<title><?= $title ?></title>

<?= $stylesheet ?>
<?= $scripts ?>
</head>

<body>
<div id="container">

<div id="header">
    <a href="/">Adri &amp; Aleksey</a>
</div>
<div id="header-date">
   May 21, 2011
</div>

<div id="navigation">
        <ul>
        <li><a href="faq.php">FAQ</a></li>
        <li><a href="photos.php">Photos</a></li>
        <li><a href="/">Home</a></li>
        </ul>
</div>

<div id="main">
<?php
}

function page_footer() {
?>
</div>
<div id="footer">
adri.and.aleksey@gmail.com
<!-- Footer -->
</div>
        
</div>

</body>
</html>
<?php
}

function form_header($title, $heading) {
  echo "<h1 class=\"form-title\">$heading</h1>";
}

function form_footer() {
  echo "";
}


function page_header_short($title, $form=null) {

  $stylesheet = "<link rel=\"stylesheet\" type=\"text/css\" href=\"css/main.css\" />";
  if ($form) { $stylesheet .= "\n<link rel=\"stylesheet\" type=\"text/css\" href=\"css/form.css\" />\n"; }

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">

<html>
<head>

<title><?= $title ?></title>

<?= $stylesheet ?>

</head>

<body>
<?php
}

function page_footer_short() {
?>
</body>
</html>
<?php
}



?>
