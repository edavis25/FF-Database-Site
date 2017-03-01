<h1>Query Results View</h1>

<?php 
	foreach ($data as $row) {
		foreach ($row as $col) {
			echo $col;
		}
		echo "<br />";
	}
?>