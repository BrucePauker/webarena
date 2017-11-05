<div class="container-fluid">
    <div class="row mt-5 mb-5 justify-content-center">
        <div class="card w-75">
            <div class="card-header">
                Change Password
            </div>
            <div class="card-body">
                <div class="users form">
                    <?= $this->Flash->render() ?>
                    <?= $this->Form->create() ?>
                    <fieldset>
                        <?= $this->Form->control('password', ['class'=>'form-control']) ?>
                        <?= $this->Form->control('confirm_password', ['class'=>'form-control', 'type' => 'password']) ?>
                    </fieldset>
                    <?= $this->Form->button(__('Reset'),['class'=>'btn btn-primary mt-4 float-right']); ?>
                    <?= $this->Form->end() ?>
                </div>
            </div>
            <div class="card-footer text-muted">
                <?= $this->Html->link('Forgot Password', ['controller' => 'Players', 'action' => 'forgotPassword'], ['class' => 'blue-link']) ?>
            </div>
        </div>
    </div>
</div>
