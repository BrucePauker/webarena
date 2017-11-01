<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Create your Message !
            </div>
            <div class="card-body">
                <div class="players form">
                    <?= $this->Form->create($message) ?>
                    <fieldset>
                        <?= $this->Form->input('fighter_id',['class'=>'form-control', 'id' => 'searchName']) ?>
                        <p id="appendAuto"></p>
                        <?= $this->Form->input('title',['class'=>'form-control']) ?>
                        <?= $this->Form->textarea('message',['class'=>'form-control', 'placeholder' => 'Message']) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Add'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>