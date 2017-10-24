<div class="row mt-3 mb-3">
    <div class="col-12 mb-3 align-self-center">
        <div class="card">
            <div class="card-body">
                <nav class="nav justify-content-center">
                    <div class="col-6">
                        <button class="btn btn-info nav-link m-auto">Change avatar</button>
                    </div>
                    <div class="col-6">
                        <button class="btn btn-info nav-link m-auto">Pass Level</button>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-4 mb-3 align-self-center">
        <div class="card">
            <div class="card-body">
                <h5 class="mb-2">Name : <?= $fighter->name ?></h5>
                <p>Coordinate X : <?= $fighter->coordinate_x ?></p>
                <p>Coordinate Y : <?= $fighter->coordinate_y ?></p>
                <p>Level : <?= $fighter->level ?></p>
                <p>XP : <?= $fighter->xp ?></p>
                <p>Sight Skill : <?= $fighter->skill_sight ?></p>
                <p>Strenght Skill : <?= $fighter->skill_strength ?></p>
                <p>Health Skill : <?= $fighter->skill_health ?></p>
                <p>Current Health : <?= $fighter->current_health ?></p>
            </div>
        </div>
    </div>
    <div class="col-12 col-md-8 align-self-center">
        <div class="sketchfab-embed-wrapper"><iframe width="100%" height="400" src="https://sketchfab.com/models/eb61a40018674f1db233b460eec4914c/embed" frameborder="0" allowvr allowfullscreen mozallowfullscreen="false" webkitallowfullscreen="false" onmousewheel=""></iframe>
        </div>
    </div>
</div>