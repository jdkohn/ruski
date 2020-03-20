<?php

include "db_connect.php";

$sql = "SELECT * FROM settings WHERE name='status'";

foreach($conn->query($sql) as $row) {
	echo $row["value"];
}

$conn->close();

?>