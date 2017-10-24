<div class="row mt-4">
    <div class="col-2">
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
    </div>
    <div id="carouselControls" class="carousel slide col-8" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($fighters as $key => $fighter): ?>
                    <div class="carousel-item <?php if($key == 0) echo('active')  ?>">
                        <div class="card m-auto" style="width: 20rem;">
                            <img class="card-img-top" src="/webArena/img/logo.png" alt="Card image cap">
                            <div class="card-body text-center">
                                <h4 class="card-title"><?= $fighter->name ?></h4>
                                <?= $this->Html->link('See more', ['controller' => 'Fighters', 'action' => 'view/'.$fighter->id], ['class'=>'btn btn-light']) ?>
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
</div>
    
    
