<?php

include "db_connect.php";

$query_string = $_SERVER['QUERY_STRING'];
$query_parts = explode('&', $query_string);

$fields = array();

foreach($query_parts as $part) {
	$key_val = explode('=', $part);
	$fields[$key_val[0]] = $key_val[1];
}

// $where_clause = "game_id=" . $fields['game_id'] . " AND player_id=" . $fields["player_id"];

$fields_clause = "(";
$values_clause = "(";

foreach(array_keys($fields) as $stat) {
	$fields_clause = $fields_clause . $stat . ", ";
	$values_clause = $values_clause . $fields[$stat] . ", ";
}

$values_clause = substr($values_clause, 0, -4);
$fields_clause = substr($fields_clause, 0, -4);

$fields_clause = $fields_clause . ")";
$values_clause = $values_clause . ")";

$sql = "INSERT INTO statline " . $fields_clause . " VALUES " . $values_clause . ";";

$success = FALSE;

if($conn->query($sql) === TRUE) {
	$success = TRUE;
} else {
	echo $conn->error;
}

$return = array(
	"success" => $success
);

echo json_encode($return);

?>