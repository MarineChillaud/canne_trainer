<?php $this->assign('title', __('S\'inscrire')); ?>

<div class='container-fluid'>

    <div class="row">
        <main class='col-12 col-lg-8 p-3'>
            <h1><?= __('S\'inscrire') ?></h1>

            <?= $this->Form->create($user) ?>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'label' => __('Adresse électronique'),
                    'type' => 'email',
                    'required' => true,
                    'class' => 'form-control'
                ]) ?>
                <?= $this->Form->control('password', [
                    'label' => __('Mot de passe'),
                    'required' => true,
                    'class' => 'form-control'
                ]); ?>
                <?= $this->Form->control('lastName', [
                    'label' => __('Nom de famille'),
                    'required' => true,
                    'class' => 'form-control'
                ]); ?>
                <?= $this->Form->control('firstName', [
                    'label' => __('Prénom'),
                    'required' => true,
                    'class' => 'form-control'
                ]); ?>
            </div>

            <?= $this->Form->submit(__('Inscription'), ['class' => 'btn btn-outline-primary']) ?>
            <?= $this->Form->end() ?>
        </main>
    </div>
</div>