<?php

include "db_connect.php";

$sql = "SELECT * FROM game ORDER BY date DESC LIMIT 50";

$return = array();
$results = array();

foreach($conn->query($sql) as $row) {
	$game = array(
		"homeOne" => $row["homeOne"],
		"homeTwo" => $row["homeTwo"],
		"awayOne" => $row["awayOne"],
		"awayTwo" => $row["awayTwo"],
		"homeScore" => $row["homeScore"],
		"awayScore" => $row["awayScore"],
		"tournament" => $row["tournament"],
		"live" => $row["live"],
		"date" => $row["date"],
		"id" => $row["id"]
	);
	array_push($results, $game);
}

$return["success"] = "true";
$return["games"] = $results;

echo json_encode($return);

?>