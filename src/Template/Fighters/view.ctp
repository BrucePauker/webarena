<div class="row mt-3 mb-3">
    <div class="col-12 align-self-center">
        <div class="card">
            <div class="card-body">
                <nav class="nav justify-content-center">
                    <button class="btn btn-warning nav-link">Change avatar</button>
                    <button class="btn btn-warning nav-link"><?= $this->Html->link('Create Fighter', ['controller' => 'Fighters', 'action' => 'add']) ?></button>
                    <button class="btn btn-warning nav-link">Pass Level</button>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
        <div class="col-4 align-self-center">
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-2">Name : <?= $fighter->name ?></h5>
                    <p class="card-text">Coordinate X : <?= $fighter->coordinate_x ?></p>
                    <p class="card-text">Coordinate Y : <?= $fighter->coordinate_y ?></p>
                    <p class="card-text">Level : <?= $fighter->level ?></p>
                    <p class="card-text">XP : <?= $fighter->xp ?></p>
                    <p class="card-text">Sight Skill : <?= $fighter->skill_sight ?></p>
                    <p class="card-text">Strenght Skill : <?= $fighter->skill_strength ?></p>
                    <p class="card-text">Health Skill : <?= $fighter->skill_health ?></p>
                    <p class="card-text">Current Health : <?= $fighter->current_health ?></p>
                </div>
            </div>
        </div>
        <div class="col-8 align-self-center">
            <div class="sketchfab-embed-wrapper"><iframe width="100%" height="400" src="https://sketchfab.com/models/eb61a40018674f1db233b460eec4914c/embed" frameborder="0" allowvr allowfullscreen mozallowfullscreen="false" webkitallowfullscreen="false" onmousewheel=""></iframe>
            </div>
        </div>
    </div>