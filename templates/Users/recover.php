<?php $this->assign('title', __('S\'inscrire')); ?>

<div class='container-fluid'>

    <div class="row">
        <main class='col-12 col-lg-8 p-3'>
            <h1><?= __('Récupérer son mot de passe') ?></h1>

            <?= $this->Form->create(null, ['class' => 'my-form-class']) ?>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'label' => __('Adresse électronique'),
                    'type' => 'email', 'required' => true,
                    'class' => 'form-control'
                ])
                ?>
            </div>
            <p><?= __('Si l\'adresse mail est associée à un compte Canne Trainer, un mot de passe sera renvoyé à cette adresse') ?></p>
            <?= $this->Form->submit(__('Récupération'), [
                'class' => 'btn btn-outline-primary'
            ])
            ?>
            <?= $this->Form->end() ?>
        </main>
    </div>