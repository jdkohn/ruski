<?php

include "db_connect.php";

$home_team = mysqli_real_escape_string($conn, $_GET["home"]);
$away_team = mysqli_real_escape_string($conn, $_GET["away"]);
$tournament = mysqli_real_escape_string($conn, $_GET["tournament"]);

$sql = "INSERT INTO games (home_team, away_team, tournament, date) VALUES ('$home_team', '$away_team', '$tournament', NOW());";

$id = null;
$game = null;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

if($id !== null) {
	$game = array(
		"home_team" => $home_team,
		"away_team" => $away_team,
		"tournament" => $tournament,
		"id" => $id
	);
}

$return = array(
	"success" => "true",
	"game" => $game
);

echo json_encode($return);

?>