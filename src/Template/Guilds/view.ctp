<?php $isIn = false; ?>
    <?php foreach($guild->fighters as $fighter): ?>
        <?php if($currentFighter->id == $fighter->id): ?>
            <?php $isIn = true; break; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <div class="row mt-3 justify-content-center">
        <div class="col-6 text-center">
            <?php if($isIn): ?>
                <?= $this->Html->link('Leave', ['controller' => 'Guilds', 'action' => 'leave/'.$guild->id], ['class'=>'btn btn-danger']) ?>
            <?php else: ?>
                <?= $this->Html->link('Join', ['controller' => 'Guilds', 'action' => 'join/'.$guild->id], ['class'=>'btn btn-success']) ?>
            <?php endif ?>
        </div>
    </div>
    


<div class="row justify-content-center mt-1">
    <?php if(isset($guilds->fighters) && $guilds->fighters->count() > 1): ?>
        <div class="col-2">
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <img class="img-fluid" src="/webArena/img/previous.png" alt="Previous">
            </a>
        </div>
    <?php endif ?>
    <div id="carouselControls" class="carousel slide col-8 mb-5" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($guild->fighters as $key => $fighter): ?>
                <div class="carousel-item <?php if($key == 0) echo('active')  ?>">
                    <div class="card text-white bg-dark m-auto" style="max-width: 20rem;">
                        <?php echo '<img src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" class="card-img-top img-fluid rounded" width="150">' ?>
                        <div class="card-body text-center">
                            <h4 class="card-title"><?= $fighter->name ?></h4>
                            <?= $this->Html->link('See more', ['controller' => 'Fighters', 'action' => 'view/'.$fighter->id], ['class'=>'btn btn-dark']) ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if(isset($guilds->fighters) && $guilds->fighters->count() > 1): ?>
        <div class="col-2">
            <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <img class="img-fluid" src="/webArena/img/forward.png" alt="Next">
            </a>
        </div>
    <?php endif ?>
</div>
    
    
