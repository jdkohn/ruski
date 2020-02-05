<?php

include "db_connect.php";

$query_string = $_SERVER['QUERY_STRING'];
$query_parts = explode('&', $query_string);

$fields = array();

foreach($query_parts as $part) {
	$key_val = explode('=', $part);
	$fields[$key_val[0]] = $key_val[1];
}

$where_clause = "game_id=" . $fields['game_id'] . " AND player_id=" . $fields["player_id"];

$update_clause = "";

foreach(array_keys($fields) as $stat) {
	if(!in_array($stat, ['game_id', 'player_id'])) {
		$update_clause = $update_clause . $stat . "=" . $fields[$stat] . ", ";
	}
}

$update_clause = substr($update_clause, 0, -2);

$sql = "UPDATE statline SET " . $update_clause . " WHERE " . $where_clause . ";";

$success = FALSE;

if($conn->query($sql) === TRUE) {
	$success = TRUE;
}

$return = array(
	"success" => $success
);

echo json_encode($return);

?>