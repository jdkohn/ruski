<?php

include "db_connect.php";

$name = mysqli_real_escape_string($conn, $_GET["name"]);
$nickname = mysqli_real_escape_string($conn, $_GET["nickname"]);

$sql = "INSERT INTO players (name, nickname) VALUES ('$name', '$nickname')";

$id;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

$update_compiled_stats_sql = "INSERT INTO compiledstats (player, makes, shots, ginobs, madeginobs, voms, difectas, trifectas, ballsback, forcedOTs, games, redemptionmakes, redemptionshots) VALUES ('$id', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
$conn->query($update_compiled_stats_sql);

$update_tourney_stats_sql = "INSERT INTO tourneystats (player, makes, shots, ginobs, madeginobs, voms, difectas, trifectas, ballsback, forcedOTs, games, redemptionmakes, redemptionshots) VALUES ('$id', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
$conn->query($update_tourney_stats_sql);

$player = array(
	"name" => $name,
	"nickname" => $nickname,
	"id" => $id
);

$return = array(
	"success" => "true",
	"player" => $player
);

echo json_encode($return);

?>