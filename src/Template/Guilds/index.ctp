<div class="container-fluid">
    <div class="row mt-5 justify-content-center">
        <?php foreach ($guilds as $guild): ?>
            <div class="card w-75">
                <div class="card-header">
                    <?php echo $guild->name ?>
                </div>
                <div class="card-body">
                    <?= $this->Html->link('See more', ['controller' => 'Guilds', 'action' => 'view/'.$guild->id], ['class'=>'btn btn-dark']) ?>
                </div>
            </div>
        <?php endforeach;?>
    </div>
</div>