<div class="row mt-3 justify-content-center">
    <button class="btn btn-info"><?= $this->Html->link('Create Fighter', ['controller' => 'Fighters', 'action' => 'add']) ?></button>
</div>
<div class="row mt-1">
    <div class="col-2">
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <img class="img-fluid" src="/webArena/img/previous.png" alt="Previous">
        </a>
    </div>
    <div id="carouselControls" class="carousel slide col-8" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($fighters as $key => $fighter): ?>
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
            <img class="img-fluid" src="/webArena/img/forward.png" alt="Next">
        </a>
    </div>
</div>
    
    
