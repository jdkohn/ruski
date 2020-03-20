<?php

include "db_connect.php";

$sql = "SELECT * FROM players";

$return = array();

$players = array();

foreach($conn->query($sql) as $row) {
	$players[$row["id"]] = array(
		"name" => $row["name"],
		"nickname" => $row["nickname"]
	);
}

$return["success"] = "true";
$return["players"] = $players;

echo json_encode($return);

?>