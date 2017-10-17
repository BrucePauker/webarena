<div class="container-fluid">
	<div class="row mt-5 justify-content-center">
		<div class="card w-75">
			<div class="card-header">
				Log In!
			</div>
			<div class="card-body">
		    	<div class="users form">
		    		<?= $this->Flash->render() ?>
				    <?= $this->Form->create() ?>
				    <fieldset>
				        <?= $this->Form->control('email') ?>
				        <?= $this->Form->control('password') ?>
				    </fieldset>
				    <?= $this->Form->button(__('Log In'),['class'=>'btn btn-primary']); ?>
				    <?= $this->Form->end() ?>
				</div>
	  		</div>
		</div>
	</div>
	
</div>
