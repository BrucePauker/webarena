<div class="container-fluid">
    <div class="row mt-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Sign Up!
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($fighter) ?>
                    <fieldset>
                        <?= $this->Form->control('name') ?>
                        <?= $this->Form->control('coordinate_x') ?>
                        <?= $this->Form->control('coordinate_y') ?>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>

</div>