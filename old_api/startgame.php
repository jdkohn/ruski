<?php

include "db_connect.php";

$h1 = mysqli_real_escape_string($conn, $_GET["h1"]);
$h2 = mysqli_real_escape_string($conn, $_GET["h2"]);
$a1 = mysqli_real_escape_string($conn, $_GET["a1"]);
$a2 = mysqli_real_escape_string($conn, $_GET["a2"]);
$tourney = mysqli_real_escape_string($conn, $_GET["t"]);
$players = array($h1, $h2, $a1, $a2);

$sql = "INSERT INTO game (homeOne, homeTwo, awayOne, awayTwo, tournament, live, date, homeScore, awayScore) VALUES ('$h1', '$h2', '$a1', '$a2', '$tourney', 'Y', NOW(), '10', '10')";

$id;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

foreach($players as $p) {
	$sql = "INSERT INTO statline (player, game, makes, shots, ginobs, madeginobs, voms, trifectas, difectas, ballsback, forcedOTs, redemptionmakes, redemptionshots) VALUES ('$p', '$id', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0)";
	$conn->query($sql);
}

$return = array(
	"success" => TRUE,
	"id" => $id
);

echo json_encode($return);

?>