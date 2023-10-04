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
                    <?= $this->Html->link('Compétitions', '/Videos/index', ['class' => 'nav-link', 'title' => 'Compétitions']) ?>
                </li>
                <li class="nav-item ">
                    <?= $this->Html->link('Statistiques', '/publics/statistics', ['class' => 'nav-link', 'title' => 'Statistiques']) ?>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item dropdown languagepicker">
                    <a class="nav-link dropdown-toggle fr_FR" href="#" id="localemenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" title="Changer la langue de l'interface">
                        <span class="sr-only">Changer la langue de l'interface</span>
                        <span class="d-lg-none">Changer la langue de l'interface</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="localemenu">
                        <?= $this->Html->link('Français', '/publics/locale/fr_FR', ['class' => 'dropdown-item fr_FR']) ?>
                        <?= $this->Html->link('Deutsch', '/publics/locale/de', ['class' => 'dropdown-item de']) ?>
                        <?= $this->Html->link('English', '/publics/locale/en', ['class' => 'dropdown-item en']) ?>
                        <?= $this->Html->link('Magyar', '/publics/locale/hu', ['class' => 'dropdown-item hu']) ?>
                        <?= $this->Html->link('Slovenščina', '/publics/locale/sl_SI', ['class' => 'dropdown-item sl_SI']) ?>
                    </div>
                </li>

                <?php if (isset($logged_username)) : ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="profilemenu" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="far fa-user-circle" title="<?= __('Mon Compte') ?>"></i>
                            <span class="sr-only"><?= __('Mon Compte') ?>..</span>
                            <span class="d-lg-none"><?= __('Mon Compte') ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="profilemenu">
                            <?= $this->Html->link('<i class="fas fa-bell"></i> ' . __('Mes évaluations'), [
                                'controller' => 'Users',
                                'action' => '' // TODO ajouter l'action vers les stats individuelles
                            ], [
                                'class' => 'dropdown-item',
                                'escape' => false,
                                'title' => __('Les vidéos que j\'ai évalué')
                            ]);
                            ?>
                            <?= $this->Html->link('<i class="fas fa-info-circle"></i> ' . __('Profil'), [
                                'controller' => 'Users',
                                'action' => 'profile'
                            ], [
                                'class' => 'dropdown-item',
                                'escape' => false,
                                'title' => __('Mes paramètres')
                            ]);
                            ?>
                            <div class="dropdown-divider"></div>
                            <?= $this->Html->link(__('Déconnexion'), [
                                'controller' => 'Users',
                                'action' => 'logout'
                            ], [
                                'class' => 'dropdown-item'
                            ]);
                            ?>
                        </div>
                    </li>
                <?php else : ?>
                    <li class='nav-item'>
                        <?= $this->Html->link(__('Connexion'), ['controller' => 'Users', 'action' => 'login'], ['class' => 'nav-link']); ?>
                    </li>
                <?php endif; ?>
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