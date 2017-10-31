<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Create your Fighter ! 
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($fighter, ['type' => 'file']) ?>
                    <fieldset>
                        <?= $this->Form->control('name',['class'=>'form-control']) ?>
                        <label class="custom-file text-left mt-3 w-100">
                            <?= $this->Form->input('avatar_file', ['type' => file, 'class' => 'file', 'accept' => 'image/x-png,image/jpg,image/jpeg']) ?>
                          <span class="custom-file-control"></span>
                        </label>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>