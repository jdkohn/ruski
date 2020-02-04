<?php
	$query_string = $_SERVER['QUERY_STRING'];
	$query_parts = explode('&', $query_string);

	echo $query_parts;
?>