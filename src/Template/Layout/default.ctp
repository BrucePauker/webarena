<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <!-- Styles -->
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('styles.css') ?>
    <?= $this->Html->css('bootstrap.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Image and text -->



    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <?php if(!$this->request->session()->read('Auth.User.id')): ?>
            <a class="navbar-brand" href="<?= $this->Url->build([
                '_name' => 'index',
            ]); ?>">
        <?php else: ?>
                <a class="navbar-brand" href="<?= $this->Url->build([
                    'controller' => 'Arenas',
                    'action' => 'index'
                ]); ?>">
        <?php endif; ?>
            <img src="/webArena/img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
        Web Arena
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
            </ul>
            <ul class="navbar-nav mr-">
                <form class="form-inline my-2 my-lg-0">
                    <?php if(!$this->request->session()->read('Auth.User.id')): ?>
                        <li><?= $this->Html->link('Log In', ['controller' => 'Players', 'action' => 'login'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Sign Up', ['controller' => 'Players', 'action' => 'add'], ['class'=>'btn btn-light'], ['class'=>'btn btn-light']) ?></li>
                    <?php else: ?>
                        <li><?= $this->Html->link('Back to the pit !', ['controller' => 'Arenas', 'action' => 'index'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Fighters', ['controller' => 'Fighters', 'action' => 'listFighters'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Guilds', ['controller' => 'Guilds', 'action' => 'index'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Events', ['controller' => 'Events', 'action' => 'index'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Messages', ['controller' => 'Messages', 'action' => 'index'], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('My Account', ['controller' => 'Players', 'action' => 'edit/'.$this->request->session()->read('Auth.User.id')], ['class'=>'btn btn-light']) ?></li>
                        <li><?= $this->Html->link('Logout', ['controller' => 'Players', 'action' => 'logout'], ['class'=>'btn btn-light']) ?></li>
                    <?php endif; ?>
                </form>
            </ul>
        </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container-fluid clearfix">
        <?= $this->fetch('content') ?>
    </div>
    <footer class="bg-dark text-white">
        <div class="row w-75 m-auto justify-content-center">
            <div class="col-4 p-3">
                <dl>
                    <dt>Authors</dt>
                    <dd>Mathieu FRANCK</dd>
                    <dd>Bruce PAUKER</dd>
                </dl>
            </div>
            <div class="col-4 p-3">
                <dl>
                    <dt>Options</dt>
                    <dd>A: Equipments</dd>
                    <dd>B: Guilds / Messages</dd>
                    <dd>F: Bootstrap</dd>
                    <dd>Beginning of E: Avanced Interface</dd>
                </dl>
            </div>
            <div class="col-4 p-3">
                <dl>
                    <dt>Git</dt>
                    <dd>Lien vers le git</dd>
                </dl>
            </div>
        </div>
        <div class="row w-100 m-auto bg-secondary justify-content-center">
            <div class="text-center">Corpyright 2017 - Web Arena</div>
        </div>
    </footer>

    <!-- Scripts -->
    <script
            src="https://code.jquery.com/jquery-3.2.1.js"
            integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE="
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <?= $this->Html->script('script.js') ?>
    <?= $this->Html->script('bootstrap.js') ?>
</body>
</html>
