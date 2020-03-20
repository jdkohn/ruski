<?php

include "db_connect.php";

$winning_team = mysqli_real_escape_string($conn, $_GET["team"]);
$game_id = mysqli_real_escape_string($conn, $_GET["game_id"]);

$sql = "UPDATE games SET home_won_guytoguy=" . $winning_team . " WHERE game_id=" . $game_id . ";";

if($conn->query($sql) === TRUE) {
	echo "success";
} else {
	echo "error " . $conn->error;
}

$conn->close();

?>
