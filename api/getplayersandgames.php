<?php

include "db_connect.php";

$games_sql = "SELECT * FROM game ORDER BY date DESC LIMIT 50";

$return = array();
$games = array();

foreach($conn->query($games_sql) as $row) {
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
	array_push($games, $game);
}

$return["success"] = "true";
$return["games"] = $games;

$players_sql = "SELECT * FROM players";

$players = array();

foreach($conn->query($players_sql) as $row) {
	$players[$row["id"]] = array(
		"name" => $row["name"],
		"nickname" => $row["nickname"]
	);
}

$return["players"] = $players;

echo json_encode($return);

?>