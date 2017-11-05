<div class="row mt-3 mb-5 justify-content-center">
    <?php if(isset($fighters) && count($fighters) > 1): ?>
        <div class="col-2">
            <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
                <img class="img-fluid" src="/webArena/img/previous.png" alt="Previous">
            </a>
        </div>
    <?php endif; ?>
    <div id="carouselControls" class="carousel slide col-8" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($fighters as $key => $fighter): ?>
                    <div class="carousel-item <?php if($key == 0) echo('active')  ?>">
                        <div class="card text-white bg-dark m-auto" style="max-width: 20rem;">
                            <?php echo '<img src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" class="card-img-top img-fluid rounded" width="150">' ?>
                            <div class="card-body text-center">
                                <h4 class="card-title"><?= $fighter->name ?></h4>
                                <?= $this->Html->link('See more', ['controller' => 'Fighters', 'action' => 'view/'.$fighter->id], ['class'=>'btn btn-dark']) ?>
                                <?= $this->Html->link('Choose fighter', ['controller' => 'Fighters', 'action' => 'selectFighter/'.$fighter->id], ['class'=>'btn btn-dark']) ?>
                            </div>
                        </div>
                    </div>
            <?php endforeach; ?>
        </div>
    </div>
    <?php if(isset($fighters) && count($fighters) > 1): ?>
        <div class="col-2">
            <a class="carousel-control-next" href="#carouselControls" role="button" data-slide="next">
                <img class="img-fluid" src="/webArena/img/forward.png" alt="Next">
            </a>
        </div>
    <?php endif; ?>
</div>
<div class="create-fighter mb-5 mr-5 float-right">
    <a href="<?= $this->Url->build([
                'controller' => 'Fighters',
                'action' => 'add'
            ]); ?>">
        <img src="/webArena/img/plus.png" class="float-right" width="50">
    </a>
</div>












