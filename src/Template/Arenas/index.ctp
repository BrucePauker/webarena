<div class="container-fluid mt-4">
    <div class="map">
			<?php
				for ($i=0; $i<$size_y; $i++) 
				{ 
			?>
				<div class="table-row">
			<?php		
					for ($j=0; $j<$size_x; $j++) 
					{ 
			?>		<div class="col-table">
						<?php 
                            foreach ($fighters as $id => $fighter) {
                                if($fighter->coordinate_x == $j && $fighter->coordinate_y == $i)
                                {
                                    echo $fighter->name;
                                    break;
                                }
                            }
                        ?>		
                    </div>
            <?php   } ?>
				</div>
			<?php } ?>
    </div>
</div>