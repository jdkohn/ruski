<?php

include "db_connect.php";

$stat = mysqli_real_escape_string($conn, $_GET["stat"]);
$team = mysqli_real_escape_string($conn, $_GET["team"]);
$player = mysqli_real_escape_string($conn, $_GET["player"]);
$game = mysqli_real_escape_string($conn, $_GET["game"]);
$level = mysqli_real_escape_string($conn, $_GET["level"]);

$fields;

if($stat === "shooting_percentage") {
	$fields = "SUM(makes) / SUM(shots) shooting_percentage";
} else if ($stat === "ginob_percentage") {
	$fields = "SUM(ginob_makes) / SUM(ginobs) ginob_shooting_percentage";
} else if ($stat === "redemption_shooting_percentage") {
	$fields = "SUM(redemption_makes) / SUM(redemption_shots) redemption_shooting_percentage";
} else if ($stat === "overtime_shooting_percentage") {
	$fields = "SUM(overtime_makes) / SUM(overtime_shots) overtime_shooting_percentage";
} else if ($stat === "all") {
	$fields = "SUM(shots) shots, SUM(makes) makes, SUM(makes) / SUM(shots) shooting_percentage, SUM(voms) voms, SUM(forced_voms) forced_voms, SUM(splash_outs) splash_outs, SUM(trifectas) trifectas, SUM(difectas) difectas, COALESCE((SUM(splash_outs) + SUM(makes)) / SUM(shots), 0) on_target_shooting_percentage, COALESCE((SUM(makes) + 3*SUM(trifectas)) / SUM(shots), 0) effective_shooting_percentage, SUM(redemption_shots) redemption_shots, SUM(redemption_makes) redemption_makes, COALESCE(SUM(redemption_makes) / SUM(redemption_shots), 0) redemption_shooting_percentage, COALESCE(SUM(ot_makes) / SUM(ot_shots), 0) overtime_shooting_percentage, SUM(shots_defended) shots_defended, SUM(cups_knocked_over) cups_knocked_over";
} else {
	$fields = "SUM(" . $stat . ")";
}

$filter = "";

if($team !== "") {
	$filter = $filter . " AND team_id=" . $team;
} else if ($player !== "") {
	$filter = $filter . " AND player_id=" . $player;
} else if ($game !== "") {
	$filter = $filter . " AND game_id=" . $game;
}

$where_filter = "";

if ($player !== "" && $game !== "") {
	$where_filter = " WHERE player_id=" . $player . " AND game_id=" . $game;
} else if ($player !== "") {
	$where_filter = " WHERE player_id=" . $player;
} else if ($game !== "") {
	$where_filter = " WHERE game_id=" . $game;
}

if ($level === 'team_game') {
	// get team stats per game
	$sql = "SELECT " . $fields . ", t.team_id, game_id FROM statline s, teams t WHERE s.player_id=t.player1 OR s.player_id=t.player2 GROUP BY game_id, team_id;";
} else if ($level === "team") {
	// get overall team stats
	$sql = "SELECT " . $fields . ", t.team_id FROM statline s, teams t WHERE s.player_id=t.player1 OR s.player_id=t.player2 GROUP BY team_id;";
} else if ($level === "player_game") {
	// get player stats for game
	$sql = "SELECT " . $fields . ", player_id FROM statline s" . $where_filter . " GROUP BY game_id, player_id;";
} else if ($level === "player") {
	// get player stats overall
	$sql = "SELECT " . $fields . ", player_id FROM statline" . $where_filter . " GROUP BY player_id;";
}

$guys = [];

foreach($conn->query($sql) as $guy) {
	array_push($guys, $guy);
}

echo json_encode($guys);

?>