<?php $this->assign('title', __('Mise à jour de mon profil')); ?>

<h3><?= __('Mise à jour') ?></h3>
<?= $this->Form->create($user, ['class' => 'was-validated']) ?>

<fieldset>
    <legend><?= __('Votre profil') ?></legend>
    <?php
    echo $this->Form->control('username', [
        'label' => __('Adresse électronique'),
        'type' => 'email',
        'required' => true,
    ]);
    echo $this->Form->control('password', [
        'label' => __('Mot de passe'),
        'required' => true,
    ]);
    echo $this->Form->control('first_name', [
        'label' => __('Prénom'),
        'required' => true,
    ]);
    echo $this->Form->control('last_name', [
        'label' => __('Nom de famille'),
        'required' => true,
    ]);
    echo $this->Form->control('birth_date', [
        'label' => __('Date de naissance'),
        'required' => true,
        'minYear' => date('Y') - 90,
        'maxYear' => date('Y') - 3,
        'orderYear' => 'asc',
        'default' => (date('Y') - 30) . "-06-15",
    ]);
    $sexnames = $user->getSexNames();
    unset($sexnames[0]);
    unset($sexnames[3]);
    echo $this->Form->control('sex', [
        'label' => __('Sexe'),
        'required' => true,
        'options' => $sexnames,
    ]);
    ?>
</fieldset>
<div class="btn-group" role="group" >
    <?= $this->Form->submit(__('Mettre à jour')) ?>
    <?= $this->Html->link(__('Annuler'), ['controller' => 'personals', 'action' => 'profile'], ['class' => 'btn btn-outline-secondary', 'escape' => false]) ?>
</div>
<?= $this->Form->end() ?>