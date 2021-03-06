<div class="map mt-4">
	<div class="row">
        <div class="player-button col-12 col-md-3">
            <?php if(isset($fighter)): ?>
                <div class="row">
                    <div class="card text-white bg-dark m-auto w-75 mb-3">
                        <div class="card-header text-center"><?= $fighter->name ?></div>
                        <div class="card-body justify-content-center">
                            <?php echo '<img src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" class="card-img-top img-fluid rounded">' ?>
                            <p class="card-text text-center">Health :
                                <div class="progress">
                                    <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $fighter->current_health * 100 / $fighter->skill_health ?>%" aria-valuenow="<?= $fighter->current_health ?>" aria-valuemin="0" aria-valuemax="<?= $fighter->skill_health ?>"><?= $fighter->current_health ?></div>
                                </div>
                            </p>
                            <p class="card-text text-center">Coordinate x : <?= $fighter->coordinate_x ?></p>
                            <p class="card-text text-center">Coordinate y : <?= $fighter->coordinate_y ?></p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(isset($fighter)): ?>
                <div class="row justify-content-center mt-3 mb-3">
                    <?= $this->Html->link('Generate Tools', ['controller' => 'Tools', 'action' => 'generate'], ['class'=>'btn btn-warning']) ?>
                </div>
                <div class="row justify-content-center mt-3 mb-3">
                    <?= $this->Html->link('Shout', ['controller' => 'Events', 'action' => 'shout'], ['class'=>'btn btn-warning']) ?>
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
                <div class="row justify-content-center mb-3">
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
                                if(isset($tools)):
                                    foreach ($tools as $id => $tool) {
                                        if($tool->coordinate_x == $j && $tool->coordinate_y == $i && $tool->fighter_id == null)
                                        {

                                            echo '<img class="img-fluid popUp" src="/webarena/webroot/img/hammer.png" alt="Tools" width="50" data-container="body" data-toggle="popover" data-placement="top" data-content="Take that tool to gain skills!">';
                                            break;
                                        }
                                    }
                                endif;
                                if(isset($fighters)):
                                    foreach ($fighters as $id => $fighter) {
                                        if($fighter->coordinate_x == $j && $fighter->coordinate_y == $i)
                                        {
                                            echo '<img class="img-fluid popUp" src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" alt="Fighter" width="50" data-container="body" data-toggle="popover" data-placement="top" data-content="Fighter : '.$fighter->name.', Health : '.$fighter->current_health.'">';
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