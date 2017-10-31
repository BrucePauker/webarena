<div class="container-fluid">
        <?php foreach ($guilds as $guild): ?>
            <div class="row mt-3 justify-content-center">
                <div class="col-8">
                    <div class="card w-100 mb-3">
                        <div class="card-header">
                            <?php echo $guild->name ?>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-2 text-center">
                                    <?= $this->Html->link('See more', ['controller' => 'Guilds', 'action' => 'view/'.$guild->id], ['class'=>'btn btn-info']) ?>
                                </div>
                                <div class="col-6 col-md-2 text-center">
                                    <?php $isIn = false; ?>
                                    <?php foreach($guild->fighters as $fighter): ?>
                                        <?php if($currentFighter->id == $fighter->id): ?>
                                            <?php $isIn = true; break; ?>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                    <?php if($isIn): ?>
                                        <?= $this->Html->link('Leave', ['controller' => 'Guilds', 'action' => 'leave/'.$guild->id], ['class'=>'btn btn-danger ml-1']) ?>
                                    <?php else: ?>
                                        <?= $this->Html->link('Join', ['controller' => 'Guilds', 'action' => 'join/'.$guild->id], ['class'=>'btn btn-success']) ?>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                 
        <?php endforeach;?>
    </div>

    <div class="create-guilde position-absolute fixed-bottom mb-5 mr-5 float-right">
        <a href="<?= $this->Url->build([
                    'controller' => 'Guilds',
                    'action' => 'add'
                ]); ?>">
            <img src="/webArena/img/plus.png" class="float-right" width="50">
        </a>
    </div>
</div>


















<div class="modal fade" id="ModalGuild" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="GuildModalLabel">Create a Guild</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="guild form">
            <?= $this->Form->create($guild, ['method' => 'post', 'url' => $urlAddGuild]) ?>
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