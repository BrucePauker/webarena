<div class="container-fluid">
	<div class="row mt-5 mb-5 justify-content-center">
		<div class="card w-75">
			<div class="card-header">
				Sign Up!
			</div>
			<div class="card-body">
		    	<div class="players form">
				    <?= $this->Form->create($player,['class' => 'was-validated']) ?>
				    <fieldset>
				        <?= $this->Form->control('email', ['class'=>'form-control']) ?>
				        <?= $this->Form->control('password',  ['class'=>'form-control']) ?>
                        <?= $this->Form->control('confirm_password', ['class'=>'form-control', 'type' => 'password', 'required' => 'required']) ?>
                    </fieldset>
				    <?= $this->Form->button(__('Sign In'),['class'=>'btn btn-primary mt-4 float-right']); ?>
				    <?= $this->Form->end() ?>
				</div>
	  		</div>
		</div>
	</div>
</div>
