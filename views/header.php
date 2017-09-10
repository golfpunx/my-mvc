<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<!-- Viewport (Responsive) -->
	<meta name="viewport" content="width=device-width">
	<meta name="viewport" content="user-scalable=no">
	<meta name="viewport" content="initial-scale=1,maximum-scale=1">
	<title><?php if(isset($this->title)) echo  $this->title . " - " ; ?> Name Of Project</title>
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/font-style.css">
	<link rel="stylesheet" type="text/css" href="<?php echo URL; ?>public/css/font-awesome.min.css">
	<?php 
	if(isset($this->css)){
		foreach ($this->css as $css) {
			echo '<link rel="stylesheet" type="text/css" href="'.URL.'views/'.$css.'">';
		}
	}
	?>
</head>
<body>
	<div class="context">
	