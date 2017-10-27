<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Create your Guild ! 
            </div>
            <div class="card-body">
                <div class="guild form">
                    <?= $this->Form->create($guild) ?>
                    <fieldset>
                        <?= $this->Form->control('name',['class'=>'form-control']) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>