<div class="container-fluid mt-4">
	<div class="row">
		<div class="player-button col-3 align-self-center">
			<div class="row justify-content-center">
				<button type="button" class="btn btn-success">Haut</button>
			</div>
			<div class="row justify-content-center">
				<div class="col-6 text-center">
					<button type="button" class="btn btn-success">Gauche</button>
				</div>
				<div class="col-6 text-center">
					<button type="button" class="btn btn-success">Droite</button>
				</div>
			</div>
			<div class="row justify-content-center">
				<button type="button" class="btn btn-success">Bas</button>
			</div>
	    </div>
	    <div class="col-9 map">
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
	                                    echo '<img class="img-fluid" src="/webArena/img/fighter.png" alt="Wood" width="50">';
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
    
</div>