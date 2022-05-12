<?php
	if ($total_paginas > 1) {
		echo "<nav>";
		echo "	<ul class='pagination pagination-sm'>";
		
		if ($anterior > 0) {
			echo "<li>";
			echo "	<a href='?pg=".$anterior."' aria-label='Previous'>";
			echo "		<span aria-hidden='true'>«</span>";
			echo "	</a>";
			echo "</li>";
		} else {
			echo "<li class='disabled'>";
			echo "	<span aria-hidden='true'>«</span>";
			echo "</li>";
		}
		
		
		for ($i=1;$i<=$total_paginas;$i++) {
			if ($i < ($pg-4) AND $i == 1) {
				echo "<li><a href='?pg=".$i."'>".$i."</a></li>";
				echo "<li><a>...</a></li>";
			}
			
			if ($i >= ($pg-4) AND $i <= ($pg+4)) {
				if ($i == $pg) {
					echo "<li class='active'><a href='?pg=".$i."'>".$i."</a></li>";
				} else {
					echo "<li><a href='?pg=".$i."'>".$i."</a></li>";
				}
			}
			
			if ($i > ($pg+4) AND $i == $total_paginas) {
				echo "<li><a>...</a></li>";
				echo "<li><a href='?pg=".$i."'>".$i."</a></li>";
			}
		}
		
		if($pg < $total_paginas) {
			echo "<li>";
			echo "	<a href='?pg=".$proximo."' aria-label='Next'>";
			echo "		<span aria-hidden='true'>»</span>";
			echo "	</a>";
			echo "</li>";
		} else {
			echo "<li class='disabled'>";
			echo "	<span aria-hidden='true'>»</span>";
			echo "</li>";
		}
		
		echo "  </ul>";
		echo "</nav>";
	}
?>