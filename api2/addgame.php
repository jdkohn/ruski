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

if ($id !== null) {
	$get_playerid_sql = "SELECT * FROM teams WHERE team_id IN ('$home_team', '$away_team');";

	foreach($conn->query($get_playerid_sql) as $team) {
		$home = 0;

		if($team["team_id"] === $home_team) {
			$home = 1;
		}

		$create_statline_sql = "INSERT INTO statline (player_id, game_id, home_game) VALUES (" . $team['player1'] . "," . $id . "," . $home . "), (" . $team['player2'] . "," . $id . "," . $home . ");";

		$conn->query($create_statline_sql);
	}
}

?>