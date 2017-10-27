<div class="container-fluid ml-5">
    <div class="row mt-5">
        <?php foreach ($events as $event): ?>
        	<div class="row w-100">
	            <blockquote class="blockquote">
	              <p class="mb-0"><?php echo $event->name ?></p>
	              <footer class="blockquote-footer">Published on <cite title="<?php echo $event->date ?>"><?php echo $event->date ?></cite></footer>
	            </blockquote>
	        </div>
        <?php endforeach;?>
    </div>
</div>