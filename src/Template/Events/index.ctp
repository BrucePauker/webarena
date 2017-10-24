<div class="container-fluid">
    <div class="row mt-5 justify-content-center">
        <?php foreach ($events as $event): ?>
            <div class="card w-75">
                <div class="card-header">
                    <?php echo $event->name ?>
                </div>
                <div class="card-body">
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>