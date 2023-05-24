<?php

$cakeDescription = 'Canne Trainer';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="/css/homemade/flags.css"/>        
    <link rel="stylesheet" href="/css/homemade/cannecounter.css"/>   
    <link rel="stylesheet" href="/css/bootstrap.min.css"/>  
    <script src="https://kit.fontawesome.com/b99a638360.js" crossorigin="anonymous"></script>

    <?php echo $this->Html->css("bootstrap.min.css"); ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top shadow">
        <a href="/" class="navbar-brand"><img src="/img/logo.png" alt=""/>CanneTrainer</a>            
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
            <ul  class="navbar-nav my-2 my-lg-0">
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
                    <a href="/personals/login" class="nav-link">Connexion</a>                        
                </li>
            </ul>
        </header>
    </nav>
    <div class='container-fluid'>
        <div class="row"></div>
        <div class="row">
            <nav class='col d-none d-lg-block navbar navbar-dark bg-dark' id='localnav'></nav>
            <main class=class='col-12 col-lg-8 p-3'>
                    <h1>Bienvenue sur CanneTrainer</h1>

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
                <img src="/img/logo.png" class="mh-25" style="float:left;" alt=""/>                    
                <address style='float:right'>©Marine Chillaud v1.0</address>
                Ce site est en production mais des erreurs restent possibles -<a href="/pages/about">Crédits</a>-<a href="/pages/legal">Mentions légales</a>                
            </aside>
            <div class='col d-none d-lg-block'></div>
        </footer>
    </div>

    <script src="/js/jquery-3.6.4.min.js"></script>        
    <script src="/js/popper.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>   
</body>
</html>
