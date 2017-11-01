<div class="map mt-4">
	<div class="row">
        <div class="player-button col-12 col-md-3">
            <div class="row">
                <div class="card text-white bg-dark m-auto w-75 mb-3">
                  <div class="card-header text-center"><?= $fighter->name ?></div>
                  <div class="card-body justify-content-center">
                    <?php echo '<img src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" class="card-img-top img-fluid rounded">' ?>
                    <p class="card-text text-center">Health : <?= $fighter->current_health ?></p>
                  </div>
                </div>
            </div>
            <?php if(isset($fighter)): ?>
                <div class="row justify-content-center mt-3 mb-3">
                    <?= $this->Html->link('Shout', ['controller' => 'Events', 'action' => 'add'], ['class'=>'btn btn-warning']) ?>
                </div>
                <div class="row justify-content-center">
                    <?= $this->Html->link('Up', ['controller' => 'Arenas', 'action' => 'makeAction/up'], ['class'=>'btn btn-success']) ?>
                </div>
                <div class="row justify-content-center">
                    <div class="col-6 text-center">
                        <?= $this->Html->link('Left', ['controller' => 'Arenas', 'action' => 'makeAction/left'], ['class'=>'btn btn-success']) ?>
                    </div>
                    <div class="col-6 text-center">
                        <?= $this->Html->link('Right', ['controller' => 'Arenas', 'action' => 'makeAction/right'], ['class'=>'btn btn-success']) ?>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <?= $this->Html->link('Down', ['controller' => 'Arenas', 'action' => 'makeAction/down'], ['class'=>'btn btn-success']) ?>
                </div>
            <?php endif; ?>
        </div>
	    <div class="col-12 col-md-9 grid">
				<?php
					for ($i=0; $i<$size_y; $i++) 
					{ 
				?>
					<div class="table-row-<?php echo $i ?>">
				<?php
						for ($j=0; $j<$size_x; $j++) 
						{
						    if(isset($fighter) && $fighter->isOnSight($fighter, $j, $i))
						        echo '<div class="col-table-'.$j.' on-sight">';
						    else
                                echo '<div class="col-table-'.$j.'">';
				?>
							<?php
                                if(isset($fighters)):
                                    foreach ($fighters as $id => $fighter) {
                                        if($fighter->coordinate_x == $j && $fighter->coordinate_y == $i)
                                        {
                                            echo '<img class="img-fluid" src="/webarena/webroot/img/avatars/'.$fighter->player->id.'_'.$fighter->id.'.jpg" alt="Wood" width="50">';
                                            break;
                                        }
                                    }
                                endif;
	                        ?>		
	                    </div>
	            <?php   } ?>
					</div>
				<?php } ?>
	    </div>
	</div>
    
</div>