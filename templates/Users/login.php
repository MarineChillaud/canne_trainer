<?php $this->assign('title', __('Se connecter')); ?>

<div class='container-fluid'>

    <div class="row">
        <main class='col-12 col-lg-8 p-3'>
            <h1><?= __('Se connecter') ?></h1>

            <?= $this->Form->create(null, ['class' => 'my-form-class']) ?>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'label' => __('Adresse électronique'),
                    'type' => 'email', 'required' => true,
                    'class' => 'form-control'
                ])
                ?>
                <?= $this->Form->control('password', [
                    'label' => __('Mot de passe'),
                    'required' => true,
                    'class' => 'form-control'
                ])
                ?>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <?= $this->Form->control('rememberme', [
                        'label' => __('rester connecté'),
                        'type' => 'checkbox',
                        'class' => 'form-check-input'
                    ])
                    ?>
                </div>
            </div>
            <?= $this->Form->submit(__('Connexion'), [
                'class' => 'btn btn-outline-primary'
            ])
            ?>
            <?= $this->Form->end() ?>

            <div class='button-group text-right'>
                <?= $this->Html->link(__('Récupérer son mot de passe'), ['controller' => 'users', 'action' => 'recover'], ['class' => 'btn btn-outline-info']) ?>
                <?= $this->Html->link(__('Inscription'), ['controller' => 'users', 'action' => 'registration'], ['class' => 'btn btn-outline-light']) ?>
            </div>
        </main>
    </div>