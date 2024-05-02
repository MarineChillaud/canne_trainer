<?php $this->assign('title', __('Mise à jour de mon profil')); ?>

<div class='container-fluid'>
    <div class="row">
        <main class='col-12 col-lg-8 p-3'>
            <h3><?= __('Mise à jour') ?></h3>
            <?= $this->Form->create($user, ['context' => ['table' => 'Users'], 'class' => 'was-validated']) ?>

            <legend><?= __('Votre profil') ?></legend>
            <div class="form-group">
                <?= $this->Form->control('username', [
                    'label' => __('Adresse électronique'),
                    'type' => 'email',
                    'required' => true,
                    'class' => 'form-control'

                ]); ?>
                <?= $this->Form->control('password', [
                    'label' => __('Mot de passe'),
                    'required' => true,
                    'class' => 'form-control'

                ]); ?>
                <?= $this->Form->control('firstName', [
                    'label' => __('Prénom'),
                    'required' => true,
                    'class' => 'form-control'

                ]); ?>
                <?= $this->Form->control('lastName', [
                    'label' => __('Nom de famille'),
                    'required' => true,
                    'class' => 'form-control'

                ]); ?>
            </div>
            <div class="btn-group" role="group">
                <?= $this->Form->submit(__('Mettre à jour'), ['class' => 'btn btn-outline-primary']) ?>
                <?= $this->Html->link(__('Annuler'), ['controller' => 'users', 'action' => 'profile'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
            </div>
            <?= $this->Form->end() ?>
        </main>
    </div>
</div>