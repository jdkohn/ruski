<?php

include "db_connect.php";

$conn->query("DELETE FROM tourneystats WHERE player > 0");

$get_players_sql = "SELECT * FROM players";

foreach($conn->query($get_players_sql) as $p) {
	$player = $p["id"];
	$tourney_games_sql = "SELECT * FROM game WHERE tournament='Y' AND (homeOne='$player' OR homeTwo='$player' OR awayOne='$player' OR awayTwo='$player')";

	$makes = $shots = $ginobs = $madeginobs = $voms = $trifectas = $difectas = $ballsback = $forcedOTs = $redemptionShots = $redemptionMakes = $games = 0;

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
			$games = $games + 1;
		}
	}

	$insert_sql = "INSERT INTO tourneystats (player, makes, shots, ginobs, madeginobs, voms, difectas, trifectas, ballsback, forcedOTs, games, redemptionmakes, redemptionshots) VALUES ('$player', " . $makes . ", " . $shots . ", " . $ginobs . ", " . $madeginobs . ", " . $voms . ", " . $difectas . ", " . $trifectas . ", " . $ballsback . ", " . $forcedOTs . ", " . $games . ", " . $redemptionMakes . ", " . $redemptionShots . ")";
	$conn->query($insert_sql);
}

$conn->close();

?>	