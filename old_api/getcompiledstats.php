<?php

include "db_connect.php";

$sql = "SELECT * FROM compiledstats";

$makes = array();
$shots = array();
$ginobs = array();
$madeginobs = array();
$voms = array();
$difectas = array();
$trifectas = array();
$ballsback = array();
$forcedOTs = array();
$cupspergame = array();
$shootingpercentage = array();
$ginobpercentage = array();
$ginobshootingpercentage = array();



foreach($conn->query($sql) as $row) {
	$arr = array(
		"player" => $row["player"],
		"games" => $row["games"],
		"makes" => $row["makes"],
		"shots" => $row["shots"],
		"ginobs" => $row["ginobs"],
		"madeginobs" => $row["madeginobs"],
		"voms" => $row["voms"],
		"difectas" => $row["difectas"],
		"trifectas" => $row["trifectas"],
		"ballsback" => $row["ballsback"],
		"forcedOTs" => $row["forcedOTs"]
	);

	if($arr["games"] > 0) {
		$arr["cupspergame"] = $row["makes"] / $row["games"];
	} else {
		$arr["cupspergame"] = "0";
	}

	if($arr["shots"] > 0) {
		$arr["shootingpercentage"] = $row["makes"] / $row["shots"];
		$arr["ginobpercentage"] = $row["ginobs"] / $row["shots"];
	} else {
		$arr["shootingpercentage"] = "0";
		$arr["ginobpercentage"] = "0";
	}

	if($arr["ginobs"] > 0) {
		$arr["ginobshootingpercentage"] = $row["madeginobs"] / $row["ginobs"];
	} else {
		$arr["ginobshootingpercentage"] = "0";
	}

	array_push($makes, array($row["player"] => $row["makes"]));
	array_push($shots, array($row["player"] => $row["shots"]));
	array_push($ginobs, array($row["player"] => $row["ginobs"]));
	array_push($madeginobs, array($row["player"] => $row["madeginobs"]));
	array_push($voms, array($row["player"] => $row["voms"]));
	array_push($difectas, array($row["player"] => $row["difectas"]));
	array_push($trifectas, array($row["player"] => $row["trifectas"]));
	array_push($ballsback, array($row["player"] => $row["ballsback"]));
	array_push($forcedOTs, array($row["player"] => $row["forcedOTs"]));
	array_push($cupspergame, array($row["player"] => $arr["cupspergame"]));
	array_push($shootingpercentage, array($row["player"] => $arr["shootingpercentage"]));
	array_push($ginobpercentage, array($row["player"] => $arr["ginobpercentage"]));
	array_push($ginobshootingpercentage, array($row["player"] => $arr["ginobshootingpercentage"]));
}

$stats = array(
	"makes" => $makes,
	"shots" => $shots,
	"ginobs" => $ginobs,
	"madeginobs" => $madeginobs,
	"voms" => $voms,
	"difectas" => $difectas,
	"trifectas" => $trifectas,
	"ballsback" => $ballsback,
	"forcedOTs" => $forcedOTs,
	"cupspergame" => $cupspergame,
	"shootingpercentage" => $shootingpercentage,
	"ginobpercentage" => $ginobpercentage,
	"ginobshootingpercentage" => $ginobshootingpercentage
)

$return = array(
	"success" => TRUE,
	"stats" => $stats
);

echo json_encode($return);

$conn->close();

?>