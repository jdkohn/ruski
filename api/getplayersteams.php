<?php

include "db_connect.php";

$sql = "SELECT t.team_id, p1.player_id as player1_id, p1.name as player1_name, p2.player_id as player2_id, p2.name as player2_name FROM teams t LEFT JOIN players p1 ON t.player1 = p1.player_id LEFT JOIN players p2 ON t.player2=p2.player_id";

// echo $sql;

$teams = [];

foreach($conn->query($sql) as $team) {
	array_push($teams, $team);
}

echo json_encode($teams);

?>
