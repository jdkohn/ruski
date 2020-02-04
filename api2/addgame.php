<?php

include "db_connect.php";

$home_team = mysqli_real_escape_string($conn, $_GET["home"]);
$away_team = mysqli_real_escape_string($conn, $_GET["away"]);
$tournament = mysqli_real_escape_string($conn, $_GET["tournament"]);

$sql = "INSERT INTO games (home_team, away_team) VALUES ('$home', '$away', '$tournament');";

$id;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

$game = array(
	"home_team" => $home_team,
	"away_team" => $away_team,
	"tournament" => $tournament,
	"id" => $id
);

$return = array(
	"success" => "true",
	"game" => $game
);

echo json_encode($return);

?>