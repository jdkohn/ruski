<?php

include "db_connect.php";

$sps = array();

foreach($conn->query("SELECT * FROM players") as $p) {
	$id = $p["id"];
	$name = $p["name"];
	$makes = 0;
	$shots = 0;
	foreach($conn->query("SELECT * FROM statline WHERE player='$id'") as $s) {
		$makes = $makes + $s["makes"];
		$shots = $shots + $s["shots"];
	}
	$perc = $makes / $shots;
	$player = array(
		"name" => $name,
		"sp" => $perc
	);
	array_push($sps, $player);
}

array_multisort($sps, SORT_DESC);

echo json_encode($sps);

?>