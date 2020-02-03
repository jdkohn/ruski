<?php

include "db_connect.php";

$game = mysqli_real_escape_string($conn, $_GET["game"]);

$sql = "SELECT * FROM statline WHERE game='$game'";

$return = array(
	"success" => TRUE
);

$stats = array();

foreach($conn->query($sql) as $row) {
	$line = array(
		"player" => $row["player"],
		"makes" => $row["makes"],
		"shots" => $row["shots"],
		"ginobs" => $row["ginobs"],
		"madeginobs" => $row["madeginobs"],
		"voms" => $row["voms"],
		"trifectas" => $row["trifectas"],
		"difectas" => $row["difectas"],
		"ballsback" => $row["ballsback"],
		"forcedOTs" => $row["forcedOTs"]
	);
	array_push($stats, $line);
}

$return["stats"] = $stats;

echo json_encode($return);

?>