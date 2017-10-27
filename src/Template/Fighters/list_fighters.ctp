<div class="row mt-3 mb-5">
    <div class="col-2">
        <a class="carousel-control-prev" href="#carouselControls" role="button" data-slide="prev">
            <img class="img-fluid" src="/webArena/img/previous.png" alt="Previous">
        </a>
    </div>
    <div id="carouselControls" class="carousel slide col-8" data-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($fighters as $key => $fighter): ?>
                    <div class="carousel-item <?php if($key == 0) echo('active')  ?>">
                        <div class="card text-white bg-dark m-auto" style="max-width: 20rem;">
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
<div class="create-fighter position-absolute fixed-bottom mb-5 mr-5 float-right">
    <a href="<?= $this->Url->build([
                    'controller' => 'Fighters',
                    'action' => 'add'
                ]); ?>">
            <img src="/webArena/img/plus.png" class="float-right" width="50">
        </a>
</div>
    
<div class="modal fade" id="ModalFighter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="FighterModalLabel">Create a Fighter</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="players form">
            <?= $this->Form->create($fighter) ?>
            <fieldset>
                <?= $this->Form->control('name',['class'=>'form-control']) ?>
            </fieldset>
            <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary mt-4 float-right']); ?>
            <?= $this->Form->end() ?>
        </div>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
