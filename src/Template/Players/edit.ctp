<div class="row mt-4 justify-content-center">
	<div class="col-12 col-md-4 mb-3">
		<div class="card">
			<div class="card-header">
				Your information !
			</div>
			<div class="card-body">
                <?= $this->Form->create($player) ?>
                <?= $this->Form->control('email', ['class'=>'form-control']) ?>
                <?= $this->Form->input('password',  ['class'=>'form-control']) ?>
                <?= $this->Form->input('confirm_password', ['class'=>'form-control', 'type' => 'password', 'required' => 'required']) ?>
                    <?= $this->Form->button(__('Save changes'),['class'=>'btn btn-info mt-2 float-right']); ?>
                <?= $this->Form->end() ?>
			</div>
		</div>
	</div>
</div>