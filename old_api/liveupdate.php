<?php

include "db_connect.php";

$entityBody = json_decode(file_get_contents('php://input'), TRUE);

$gameID = $entityBody["id"];
$homeScore = $entityBody["homeScore"];
$awayScore = $entityBody["awayScore"];
$homeOne = $entityBody["players"]["homeOne"];
$homeTwo = $entityBody["players"]["homeTwo"];
$awayOne = $entityBody["players"]["awayOne"];
$awayTwo = $entityBody["players"]["awayTwo"];
$players = array($homeOne, $homeTwo, $awayOne, $awayTwo);
$sql_insertions = array();

foreach($players as $p) {
	$id = $p["id"];
	$makes = $p["makes"];
	$attempts = $p["attempts"];
	$ginobs = $p["ginobs"];
	$madeGinobs = $p["madeGinobs"];
	$trifectas = $p["trifectas"];
	$difectas = $p["difectas"];
	$voms = $p["voms"];
	$ballsBack = $p["ballsBack"];
	$forcedOTs = $p["forcedOTs"];
	$redemptionshots = $p["redemptionShots"];
	$redemptionmakes = $p["redemptionMakes"];
	$updateStatlineSQL = "UPDATE statline SET makes='$makes', shots='$attempts', ginobs='$ginobs', madeginobs='$madeGinobs', voms='$voms', trifectas='$trifectas', difectas='$difectas', ballsback='$ballsBack', forcedOTs='$forcedOTs', redemptionshots='$redemptionshots', redemptionmakes='$redemptionmakes' WHERE player='$id' AND game='$gameID'";
	array_push($sql_insertions, $updateStatlineSQL);
	$conn->query($updateStatlineSQL);
}

echo json_encode(array("success" => TRUE));

?>