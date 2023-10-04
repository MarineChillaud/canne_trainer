<?php $this->assign('title', __('Profil')); ?>

<div class='container-fluid'>

    <div class="row">
        <main class='col-12 col-lg-8 p-3'>
            <h1 class='mb-5'><?= h($user->firstName . ' ' . $user->lastName) ?></h1>
            <div class='button-group text-right'>
                <?= $this->Html->link(__('Modifier'), ['controller' => 'users', 'action' => 'update'], ['class' => 'btn btn-outline-info']) ?>
            </div>
            <h2>Informations principales</h2>
            <table class="table table-striped  table-dark table-borderless table-hover">
                <tr>
                    <th><?= __('Adresse électronique') ?></th>
                    <td><?= h($user->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prénom') ?></th>
                    <td><?= h($user->firstName) ?></td>
                </tr>
                <tr>
                    <th><?= __('Nom de famille') ?></th>
                    <td><?= h($user->lastName) ?></td>
                </tr>
            </table>

        </main>
    </div>
</div>