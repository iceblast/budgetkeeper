<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title><?php echo (isset($title)) ? $title : "My CI Site" ?> </title>
	<?php echo put_headers() ?>
</head>
<body>