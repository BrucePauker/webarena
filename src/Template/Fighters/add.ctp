<div class="container-fluid">
    <div class="row mt-4 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Create your Fighter ! 
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($fighter) ?>
                    <fieldset>
                        <?= $this->Form->control('name') ?>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>

</div>