<div class="row mt-5 ml-3 mr-3">
    <div class="col-12 col-md-4 mb-3">
        <div class="row">
            <div class="card text-white bg-dark w-100 mb-5">
              <div class="card-header">Position</div>
              <div class="card-body">
                <p class="card-text">Coordinate X : <?= $fighter->coordinate_x ?></p>
                <p class="card-text">Coordinate Y : <?= $fighter->coordinate_y ?></p>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="card text-white bg-dark w-100 mt-5">
              <div class="card-header">Skills</div>
              <div class="card-body">
                <p class="card-text">Sight Skill : <?= $fighter->skill_sight ?></p>
                <p class="card-text">Strenght Skill : <?= $fighter->skill_strength ?></p>
              </div>
            </div>
        </div>
    </div>
    <div class="col-4 text-center align-self-center">
        <?php echo '<img src="/webarena/webroot/img/avatars/'.$fighter->id.'.jpg" class="img-fluid rounded" width="150">' ?>
        <h5><?= $fighter->name ?></h5>
        <?php if($fighter->player == $player): ?>
        <div class="row">
            <div class="col-4">
              <?= $this->Html->link('Edit', ['controller' => 'Fighters', 'action' => 'edit/'.$fighter->id], ['class'=>'btn btn-info nav-link m-auto']) ?>
            </div>
            <div class="col-4">
                <?= $this->Html->link('Choose fighter', ['controller' => 'Fighters', 'action' => 'selectFighter/'.$fighter->id], ['class'=>'btn btn-info nav-link m-auto wrap-button']) ?>
            </div>
            <div class="col-4">
                <?= $this->Html->link('Pass Level', ['controller' => 'Fighters', 'action' => 'edit'], ['class'=>'btn btn-info nav-link m-auto']) ?>
            </div>
        </div>
        <?php endif; ?>
    </div>
    <div class="col-12 col-md-4 mb-5">
        <div class="row">
            <div class="card text-white bg-dark w-100 mb-5">
              <div class="card-header">Experience</div>
              <div class="card-body">
                <p class="card-text">Level : <?= $fighter->level ?></p>
                <p class="card-text">XP : <?= $fighter->xp ?></p>
              </div>
            </div>
        </div>
        <div class="row">
            <div class="card text-white bg-dark w-100 mt-5">
              <div class="card-header">Health</div>
              <div class="card-body">
                <p class="card-text">Health Skill : <?= $fighter->skill_health ?></p>
                <p class="card-text">Current Health :
                  <div class="progress">
                      <div class="progress-bar bg-danger progress-bar-striped progress-bar-animated" role="progressbar" style="width: <?= $fighter->current_health * 100 / $fighter->skill_health ?>%" aria-valuenow="<?= $fighter->current_health ?>" aria-valuemin="0" aria-valuemax="<?= $fighter->skill_health ?>"><?= $fighter->current_health ?></div>
                  </div></p>
              </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Change your Avatar</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        <?= $this->Form->create($fighter, ['type' => $fighter->file]) ?>
          <div class="modal-body text-center">
            <img src="/webArena/img/logo.png" class="rounded" width="300">
            <label class="custom-file text-left">
                <?= $this->Form->input('Avatar', ['type' => file, 'class' => 'file']) ?>
              <span class="custom-file-control"></span>
            </label>
          </div>
          <div class="modal-footer">
              <?= $this->Form->button(__('Change'),['class'=>'btn btn-primary mt-4 float-right']); ?>
          </div>
        <?= $this->Form->end() ?>
    </div>
  </div>
</div>