<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                You forgot your password?
            </div>
            <div class="card-body">
                <div class="users form">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create() ?>
                    <fieldset>
                        <?= $this->Form->control('email', ['class'=>'form-control']) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Ask password'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
