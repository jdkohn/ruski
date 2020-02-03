<?php

include "db_connect.php";

$stat = mysqli_real_escape_string($conn, $_GET["stat"]);

$sql = "SELECT * FROM compiledstats ORDER BY " . $stat . " DESC";

$stats = array();

foreach($conn->query($sql) as $row) {
	$arr = array(
		"player" => $row["player"],
		"stat" => $row[$stat]
	);
	array_push($stats, $arr);
}

$return = array(
	"success" => TRUE,
	"stats" => $stats
);

echo json_encode($return);

$conn->close();

?>