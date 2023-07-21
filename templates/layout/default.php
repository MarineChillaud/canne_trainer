<?php
$siteName = 'Canne Trainer';
$siteVersion = '1.0'
?>
<!DOCTYPE html>
<html>

<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $siteName ?> : <?= $this->fetch('title') ?></title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css("bootstrap.min") ?>
    <!-- <?= $this->Html->css("fontawesome") ?> -->
    <?= $this->Html->css("homemade/flags") ?>
    <?= $this->Html->css("homemade/cannecounter") ?>


    <script src="https://kit.fontawesome.com/b99a638360.js" crossorigin="anonymous"></script>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>

<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
        <?= $this->Html->link($this->Html->image('logo.png') . " " . $siteName, '/', ['class' => 'navbar-brand', 'escapeTitle' => false]); ?>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <header class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a href="/publics/calendar" class="nav-link" title="Compétitions"><i class="fas fa-user-plus"></i>Compétitions</a>
                </li>
                <li class="nav-item ">
                    <a href="/publics/statistics" class="nav-link" title="Statistiques"><i class="fas fa-graduation-cap"></i>Statistiques</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown languagepicker">
                    <a class="nav-link dropdown-toggle fr_FR" href="#" id="localemenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Changer la langue de l'interface">
                        <span class="sr-only">Changer la langue de l'interface</span>
                        <span class="d-lg-none">Changer la langue de l'interface</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="localemenu">
                        <a href="/publics/locale/fr_FR" class="dropdown-item fr_FR">Français</a>
                        <a href="/publics/locale/de" class="dropdown-item de">Deutsch</a>
                        <a href="/publics/locale/en" class="dropdown-item en">English</a>
                        <a href="/publics/locale/hu" class="dropdown-item hu">Magyar</a>
                        <a href="/publics/locale/sl_SI" class="dropdown-item sl_SI">Slovenščina</a>
                    </div>
                </li>
                <li class='nav-item'>
                    <a href="/canne_trainer/videos/login" class="nav-link">Connexion</a>
                </li>
            </ul>
        </header>
    </nav>
    <div class='container-fluid'>
        <div class="row"></div>
        <div class="row">
            <nav class='col d-none d-lg-block navbar navbar-dark bg-dark' id='localnav'></nav>
            <main class='col-12 col-lg-8 p-3'>

                <div class='row'>
                    <?= $this->Flash->render() ?>
                    <?= $this->fetch('content') ?>
                </div>
            </main>
            <aside class='col d-none d-lg-block' id='complinfo'></aside>
        </div>
        <footer class="row py-3">
            <div class='col d-none d-lg-block'></div>
            <aside class='col-12 col-lg-8 p-3 text-center'>
                <?= $this->Html->image('logo.png', ['class' => 'mh-25', 'style' => 'float:left;']) ?>
                <address style='float:right'>©Marine Chillaud - v<?= $siteVersion ?></address>
                <?=
                (\Cake\Core\Configure::read('debug')) ?
                    __('Ce site est encore en phase de débogage, les données peuvent être effacées à tout moment') :
                    __('Ce site est en production mais des erreurs restent possibles')
                ?>
                - <?= $this->html->link('Crédits', ['controller' => 'pages', 'action' => 'about']) ?>
                - <?= $this->html->link('Mentions légales', ['controller' => 'pages', 'action' => 'legal']) ?>
            </aside>
            <div class='col d-none d-lg-block'></div>
        </footer>
    </div>

    <!-- <?= $this->Html->script('jquery-3.6.4.min'); ?>       
    <?= $this->Html->script('popper.min'); ?>        
    <?= $this->Html->script('bootstrap.min'); ?>        
    <?= $this->Html->script('scriptBottom'); ?>         -->

</body>

</html>