<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Change your Avatar ! 
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($fighter, ['type' => 'file']) ?>
                    <fieldset>
                        <label class="custom-file text-left">
                            <?= $this->Form->input('avatar_file', ['type' => file, 'class' => 'file', 'label' => 'Votre avatar (format .jpg, .jpeg, .png)']) ?>
                          <span class="custom-file-control"></span>
                        </label>
                    </fieldset>
                    <?= $this->Form->button(__('Save changes'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>