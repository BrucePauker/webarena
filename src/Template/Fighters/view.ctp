<div class="row mt-5">
    <div class="col-4">
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
                <p class="card-text">Sight Skill : <?= $fighter->sight ?></p>
                <p class="card-text">Strenght Skill : <?= $fighter->skill_strength ?></p>
              </div>
            </div>
        </div>
    </div>
    <div class="col-4 text-center align-self-center">
        <img class="img-fluid rounded" src="/webArena/img/logo.png" alt="Card image cap" width='150'>
        <h5><?= $fighter->name ?></h5>
        <div class="row">
            <div class="col-6">
                <button class="btn btn-info nav-link m-auto" data-toggle="modal" data-target="#Modal">Change Avatar</button>
            </div>
            <div class="col-6">
                <button class="btn btn-info nav-link m-auto">Pass Level</button>
            </div>
        </div>
    </div>
    <div class="col-4">
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
                <p class="card-text">Current Health : <?= $fighter->current_health ?></p>
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
      <div class="modal-body text-center">
        <img src="/webArena/img/logo.png" class="rounded" width="300">
        <label class="custom-file text-left">
          <input type="file" id="file2" class="custom-file-input">
          <span class="custom-file-control"></span>
        </label>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>