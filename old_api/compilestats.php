<?php

include "db_connect.php";

$sql = "SELECT * FROM statline";

$comp = array();

foreach($conn->query($sql) as $row) {
	if(array_key_exists($row["player"], $comp)) {
		$arr = $comp[$row["player"]];
		$arr["makes"] = $arr["makes"] + $row["makes"];
		$arr["shots"] = $arr["shots"] + $row["shots"];
		$arr["ginobs"] = $arr["ginobs"] + $row["ginobs"];
		$arr["madeginobs"] = $arr["madeginobs"] + $row["madeginobs"];
		$arr["voms"] = $arr["voms"] + $row["voms"];
		$arr["trifectas"] = $arr["trifectas"] + $row["trifectas"];
		$arr["difectas"] = $arr["difectas"] + $row["difectas"];
		$arr["ballsback"] = $arr["ballsback"] + $row["ballsback"];
		$arr["forcedOTs"] = $arr["forcedOTs"] + $row["forcedOTs"];
		$arr["games"] = $arr["games"] + 1;
		$arr["redemptionshots"] = $arr["redemptionshots"] + $row["redemptionshots"];
		$arr["redemptionmakes"] = $arr["redemptionmakes"] + $row["redemptionmakes"];
		$comp[$row["player"]] = $arr;
	} else {
		$arr = array(
			"makes" => $row["makes"],
			"shots" => $row["shots"],
			"ginobs" => $row["ginobs"],
			"madeginobs" => $row["madeginobs"],
			"ballsback" => $row["ballsback"],
			"voms" => $row["voms"],
			"trifectas" => $row["trifectas"],
			"difectas" => $row["difectas"],
			"forcedOTs" => $row["forcedOTs"],
			"redemptionmakes" => $row["redemptionmakes"],
			"redemptionshots" => $row["redemptionshots"],
			"games" => 1,
			"player" => $row["player"]
		);
		$comp[$row["player"]] = $arr;
	}
}

foreach($comp as $player) {
	$sql = "UPDATE compiledstats SET makes=" . $player["makes"] . ", shots=" . $player["shots"] . ", ginobs=" . $player["ginobs"] . ", madeginobs=" . $player["madeginobs"] . ", voms=" . $player["voms"] . ", ballsback=" . $player["ballsback"] . ", trifectas=" . $player["trifectas"] . ", difectas=" . $player["difectas"] . ", forcedOTs=" . $player["forcedOTs"] . ", games=" . $player["games"] . ", redemptionshots=" . $player["redemptionshots"] . ", redemptionmakes=" . $player["redemptionmakes"] . " WHERE player=" . $player["player"];
	$conn->query($sql);
}

?>