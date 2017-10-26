<div class="row mt-1">
    <div class="col-2">
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
    </div>
    <div id="carouselControls" class="carousel slide col-8" data-ride="carousel">
    <div class="carousel-inner">
        <?php foreach ($guild->fighters as $key => $fighter): ?>
            <div class="carousel-item <?php if($key == 0) echo('active')  ?>">
                <div class="card text-white bg-dark m-auto" style="width: 20rem;">
                    <img class="card-img-top img-fluid rounded" src="/webArena/img/logo.png" alt="Card image cap">
                    <div class="card-body text-center">
                        <h4 class="card-title"><?= $fighter->name ?></h4>
                        <?= $this->Html->link('See more', ['controller' => 'Fighters', 'action' => 'view/'.$fighter->id], ['class'=>'btn btn-dark']) ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div class="col-2">
    <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    <?php $isIn = false; ?>
    <?php foreach($guild->fighters as $fighter): ?>
        <?php if($currentFighter->id == $fighter->id): ?>
            <?php $isIn = true; break; ?>
        <?php endif; ?>
    <?php endforeach; ?>
    <?php if($isIn): ?>
        <?= $this->Html->link('Leave', ['controller' => 'Guilds', 'action' => 'leave/'.$guild->id], ['class'=>'btn btn-danger']) ?>
    <?php else: ?>
        <?= $this->Html->link('Join', ['controller' => 'Guilds', 'action' => 'join/'.$guild->id], ['class'=>'btn btn-success']) ?>
    <?php endif ?>