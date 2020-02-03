<?php

include "db_connect.php";

$player = mysqli_real_escape_string($conn, $_GET["player"]);

$tourney_games_sql = "SELECT * FROM game WHERE tournament='Y' AND (homeOne='$player' OR homeTwo='$player' OR awayOne='$player' OR awayTwo='$player')";

$stats = array();

$makes = $shots = $ginobs = $madeginobs = $voms = $trifectas = $difectas = $ballsback = $forcedOTs = $redemptionShots = $redemptionMakes = 0;

foreach($conn->query($tourney_games_sql) as $game) {
	$id = $game["id"];
	$sql = "SELECT * FROM statline WHERE player='$player' AND game='$id'";
	foreach($conn->query($sql) as $row) {
		$makes += $row["makes"];
		$shots += $row["shots"];
		$ginobs += $row["ginobs"];
		$madeginobs += $row["madeginobs"];
		$voms += $row["voms"];
		$trifectas += $row["trifectas"];
		$difectas += $row["difectas"];
		$ballsback += $row["ballsback"];
		$forcedOTs += $row["forcedOTs"];
		$redemptionMakes += $row["redemptionmakes"];
		$redemptionShots = $row["redemptionshots"];
	}
}


$stats["makes"] = $makes;
$stats["shots"] = $shots;
$stats["ginobs"] = $ginobs;
$stats["madeginobs"] = $madeginobs;
$stats["voms"] = $voms;
$stats["trifectas"] = $trifectas;
$stats["difectas"] = $difectas;
$stats["ballsback"] = $ballsback;
$stats["forcedOTs"] = $forcedOTs;
$stats["redemptionshots"] = $redemptionShots;
$stats["redemptionmakes"] = $redemptionMakes;

if($shots > 0) {
	$sp = $makes / $shots;
} else {
	$sp = 0;
}

if($ginobs > 0) {
	$gsp = $madeginobs / $ginobs;
} else {
	$gsp = 0;
}

if($shots > 0) {
	$gp = $ginobs / $shots;
} else {
	$gp = 0;
}

if($redemptionShots > 0) {
	$rp = $redemptionMakes / $redemptionShots;
} else {
	$rp = 0;
}


$stats["shootingpercentage"] = $sp;
$stats["ginobshootingpercentage"] = $gsp;
$stats["ginobpercentage"] = $gp;
$stats["redemptionpercentage"] = $rp;

// $redemptionPercentage = $ / $

$return = array(
	"success" => TRUE,
	"stats" => $stats
);

echo json_encode($return);

?>