<h4>Number of results: <?php echo sizeof($data); ?></h4>
<div class="table-responsive">
<table id="query-results-table" class="table table-hover table-striped">
	<!-- Print column headers -->
	<tr>
		<?php
			foreach ($data as $row) {
				foreach ($row as $key=>$col) {
					echo "<th>$key</th>";
				}
				break;
			}
		?>
	</tr>
	
	<!-- Print table data -->
	<?php 
		foreach ($data as $row) {
			echo "<tr>";
			foreach ($row as $col) {
				echo "<td>$col</td>";
			}
			echo "</tr>";
		}
	?>
</table>
</div> <!-- End responsive table div -->
