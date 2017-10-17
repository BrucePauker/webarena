<div class="container-fluid">
	<div class="row mt-5 justify-content-center">
		<div class="card w-75">
			<div class="card-header">
				Sign Up!
			</div>
			<div class="card-body">
		    	<div class="players form">
				    <?= $this->Form->create($player) ?>
				    <fieldset>
				        <?= $this->Form->control('email') ?>
				        <?= $this->Form->control('password') ?>
				    </fieldset>
				    <?= $this->Form->button(__('Ajouter'),['class'=>'login-btn']); ?>
				    <?= $this->Form->end() ?>
				</div>
	  		</div>
		</div>
	</div>
	
</div>
