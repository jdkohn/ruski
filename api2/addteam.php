<?php

include "db_connect.php";

$player1 = mysqli_real_escape_string($conn, $_GET["player1"]);
$player2 = mysqli_real_escape_string($conn, $_GET["player2"]);

$sql = "INSERT INTO teams (player1, player2) VALUES ('$player1', '$player2');";

$id = null;
$team = null;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

if($id !== null) {
	$team = array(
		"player1" => $player1,
		"player2" => $player2,
		"id" => $id
	);
}

$return = array(
	"success" => "true",
	"team" => $team
);

echo json_encode($return);

?>