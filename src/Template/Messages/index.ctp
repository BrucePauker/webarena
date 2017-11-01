<div class="container-fluid">
	<div class="row mt-3 justify-content-center">
		<ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
		  <li class="nav-item">
		    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-inbox" role="tab" aria-controls="pills-home" aria-selected="true">Inbox</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-sent" role="tab" aria-controls="pills-profile" aria-selected="false">Sent</a>
		  </li>
		</ul>
	</div>
	<div class="row justify-content-center">
		<div class="tab-content" id="pills-tabContent">
		  <div class="tab-pane fade show active" id="pills-inbox" role="tabpanel" aria-labelledby="pills-inobx-tab">
		  	<div class="card">
			  	<div class="card-body">
				  	<blockquote class="blockquote">
		              <p class="mb-0">From :<?php echo $messages->fighter_id_from ?></p>
		              <p class="mb-0"><?php echo $messages->message ?></p>
		              <footer class="blockquote-footer">Received on <cite title="<?php echo $messages->date ?>"><?php echo $messages->date ?></cite></footer>
		            </blockquote>
	        	</div>
	        </div>
		  </div>
		  <div class="tab-pane fade" id="pills-sent" role="tabpanel" aria-labelledby="pills-sent-tab">
		  	<div class="card">
			  	<div class="card-body">
				  	<blockquote class="blockquote">
		              <p class="mb-0">To :<?php echo $messages->fighter_id ?></p>
		              <p class="mb-0"><?php echo $messages->message ?></p>
		              <footer class="blockquote-footer">Sent on <cite title="<?php echo $messages->date ?>"><?php echo $messages->date ?></cite></footer>
		            </blockquote>
	        	</div>
	        </div>
		  </div>
		</div>
	</div>
</div>

<div class="create-guilde position-absolute mb-5 mr-5 float-right">
    <a href="<?= $this->Url->build([
        'controller' => 'Messages',
        'action' => 'add'
    ]); ?>">
        <img src="/webArena/img/plus.png" class="float-right" width="50">
    </a>
</div>
</div>