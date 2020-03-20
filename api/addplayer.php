<?php

include "db_connect.php";

$name = mysqli_real_escape_string($conn, $_GET["name"]);

$sql = "INSERT INTO players (name) VALUES ('$name');";

$id = null;
$player = null;

if($conn->query($sql) === TRUE) {
	$id = $conn->insert_id;
}

if($id !== null) {
	$player = array(
		"name" => $name,
		"id" => $id
	);
}

$return = array(
	"success" => "true",
	"player" => $player
);

echo json_encode($return);

?>