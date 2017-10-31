<div class="row mt-4 justify-content-center">
	<div class="col-12 col-md-4 mb-3">
		<div class="card">
			<div class="card-header">
				Your information !
			</div>
			<div class="card-body">
				<fieldset disabled class="mt-4 mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Email</span>
						<input type="text" class="form-control" placeholder="<?= $player->email ?>" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mt-4 mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Password</span>
						<input type="password" class="form-control" placeholder="Password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">New password</span>
						<input type="password" class="form-control" placeholder="New password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<fieldset class="mb-5">
					<div class="input-group input-group-sm">
						<span class="input-group-addon">Confirm password</span>
						<input type="password" class="form-control" placeholder="Confirm password" aria-describedby="sizing-addon2">
					</div>
				</fieldset>
				<button class="btn btn-info mt-2 float-right">Save changes</button>
			</div>
		</div>
	</div>
</div>

<div class="guild form">
    <?= $this->Form->create($player) ?>
    <fieldset>
        <?= $this->Form->control('email',['class'=>'form-control'], ['value' => 'email']) ?>
        <?= $this->Form->input('password',['class'=>'form-control']) ?>
        <?= $this->Form->input('confirm_password',['class'=>'form-control'], ['type' => 'password']) ?>
    </fieldset>
    <?= $this->Form->button(__('Save changes'),['class'=>'btn btn-primary mt-4 float-right']); ?>
    <?= $this->Form->end() ?>
</div>